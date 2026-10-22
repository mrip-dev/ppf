<?php

namespace App\Jobs;

use App\Models\CNRecord;
use App\Models\ExportRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use OpenSpout\Common\Entity\Cell;
use OpenSpout\Common\Entity\Row;
use OpenSpout\Writer\XLSX\Writer;
use OpenSpout\Common\Entity\Style\Style;
use ZipArchive;

class ExportCnRecordsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $timeout = 7200;
    public int $tries   = 1;

    private const CHUNK          = 5000;
    private const CHECKPOINT     = 2000;
    private const ROWS_PER_FILE  = 50000;

    public function __construct(public int $exportId) {}

    public function handle(): void
    {
        set_time_limit(0);
        ini_set('memory_limit', '768M');

        $export = ExportRequest::find($this->exportId);

        // Deleted or cancelled while waiting in the queue
        if (!$export || $export->status !== 'pending') {
            return;
        }

        $export->update([
            'status'           => 'processing',
            'error'            => null,
            'cancel_requested' => false,
            'heartbeat_at'     => now(),
            'processed_rows'   => 0,
        ]);

        $table    = (new CNRecord)->getTable();
        $columns  = $this->columns();
        $keys     = array_keys($columns);
        $headers  = array_merge(['ID'], array_values($columns));
        $interval = (int) $export->interval_minutes;

        $base = DB::table($table)
            ->where('board', $export->device_id)
            ->whereBetween('date', [
                $export->start_date->toDateString(),
                $export->end_date->toDateString(),
            ]);

        // ---- which rows? ----------------------------------------------------
        $ids = [];
        if ($interval > 0) {
            $bucket     = $interval * 60;
            $bucketExpr = "UNIX_TIMESTAMP(TIMESTAMP(`date`, `time`)) DIV {$bucket}";

            // 1) latest timestamp inside each bucket
            $maxTs = (clone $base)
                ->selectRaw('MAX(TIMESTAMP(`date`, `time`)) AS ts')
                ->groupByRaw($bucketExpr);

            // 2) the record(s) at that timestamp, newest first
            $picked = DB::table($table)
                ->where("{$table}.board", $export->device_id)
                ->whereBetween("{$table}.date", [
                    $export->start_date->toDateString(),
                    $export->end_date->toDateString(),
                ])
                ->joinSub($maxTs, 'm', function ($j) use ($table) {
                    $j->whereRaw("TIMESTAMP({$table}.`date`, {$table}.`time`) = m.ts");
                })
                ->orderByDesc("{$table}.date")
                ->orderByDesc("{$table}.time")
                ->orderByDesc("{$table}.id")
                ->get(["{$table}.id", "{$table}.date", "{$table}.time"]);

            // 3) if two records share the exact same second, keep only one
            $ids   = $picked->unique(fn($r) => $r->date . ' ' . $r->time)->pluck('id')->all();
            $total = count($ids);
        } else {
            $total = (clone $base)->count();
        }

        $export->update(['total_rows' => $total, 'heartbeat_at' => now()]);

        $rows = function () use ($interval, $ids, $base, $table, $keys) {
            if ($interval > 0) {
                foreach (array_chunk($ids, self::CHUNK) as $chunk) {
                    // fetch the chunk, then yield in the exact order of $chunk (date/time DESC)
                    $set = DB::table($table)->select($keys)->whereIn('id', $chunk)->get()->keyBy('id');
                    foreach ($chunk as $id) {
                        if (isset($set[$id])) {
                            yield $set[$id];
                        }
                    }
                }
                return;
            }

            // Raw mode: keyset pagination on (date, time, id) DESC
            $last = null;
            while (true) {
                $q = (clone $base)->select($keys)
                    ->orderByDesc('date')->orderByDesc('time')->orderByDesc('id')
                    ->limit(self::CHUNK);

                if ($last) {
                    $q->where(function ($w) use ($last) {
                        $w->where('date', '<', $last->date)
                            ->orWhere(fn($x) => $x->where('date', $last->date)->where('time', '<', $last->time))
                            ->orWhere(fn($x) => $x->where('date', $last->date)->where('time', $last->time)->where('id', '<', $last->id));
                    });
                }

                $set = $q->get();
                if ($set->isEmpty()) {
                    break;
                }
                foreach ($set as $r) {
                    yield $r;
                }
                $last = $set->last();
            }
        };

        // ---- descriptive names ---------------------------------------------
        $intervalLabel = $interval > 0 ? "{$interval}m" : 'raw';

        $start = $export->start_date;
        $end   = $export->end_date;
        $range = $start->format('Ymd') . '-' . ($start->year === $end->year ? $end->format('md') : $end->format('Ymd'));

        $shedShort = preg_replace('/^shed/i', 's', (string) $export->shed) ?: 's';

        $stem = implode('_', array_filter([
            Str::limit(Str::slug($export->farm_name ?: 'farm'), 12, '') . '-' . Str::slug($shedShort),
            $range,
            $intervalLabel,
        ]));

        $partsTotal = max(1, (int) ceil($total / self::ROWS_PER_FILE));

        $disk   = Storage::disk('local');
        $tmpDir = "exports/tmp-{$export->id}";
        $zipRel = "exports/{$stem}.zip";
        if ($disk->exists($zipRel)) {
            $zipRel = "exports/{$stem}-{$export->id}.zip";
        }

        $disk->deleteDirectory($tmpDir);
        $disk->makeDirectory($tmpDir);

        $writer      = null;
        $parts       = [];   // [absolute path, name inside zip]
        $partNo      = 0;
        $rowsInPart  = 0;
        $n           = 0;

        $openPart = function () use (&$writer, &$parts, &$partNo, &$rowsInPart, $disk, $tmpDir, $headers, $stem, $partsTotal) {
            $partNo++;
            $name = "{$stem}_p{$partNo}of{$partsTotal}.xlsx";
            $abs  = $disk->path("{$tmpDir}/{$name}");

            $writer = new Writer();

            // Column widths (must be set BEFORE openToFile)
            $opt = $writer->getOptions();
            $opt->setColumnWidth(8, 1);                            // ID
            $opt->setColumnWidth(14, 2);                           // Date
            $opt->setColumnWidth(12, 3);                           // Time
            $opt->setColumnWidth(20, 4);                           // Custom ID
            $opt->setColumnWidthForRange(22, 5, count($headers));  // the rest

            $writer->openToFile($abs);

            // Bold header (works on both mutable and immutable Style)
            // Bold header: style is attached per cell
            $style = new Style();
            if (method_exists($style, 'setFontBold')) {
                $style->setFontBold();
            } else {
                $style = $style->withFontBold(true);
            }

            $headerCells = array_map(fn($h) => Cell::fromValue($h, $style), $headers);
            $writer->addRow(new Row($headerCells));

            $parts[]    = [$abs, $name];
            $rowsInPart = 0;
        };

        try {
            foreach ($rows() as $r) {
                if ($writer === null) {
                    $openPart();
                } elseif ($rowsInPart >= self::ROWS_PER_FILE) {
                    $writer->close();
                    $openPart();
                }

                $n++;
                $values = [$n];
                foreach ($keys as $k) {
                    $values[] = $r->{$k} ?? '';
                }
                $writer->addRow(Row::fromValues($values));
                $rowsInPart++;

                if ($n % self::CHECKPOINT === 0) {
                    if (ExportRequest::whereKey($export->id)->value('cancel_requested')) {
                        $writer->close();
                        $disk->deleteDirectory($tmpDir);
                        ExportRequest::whereKey($export->id)->update([
                            'status'       => 'cancelled',
                            'completed_at' => now(),
                        ]);
                        return;
                    }

                    ExportRequest::whereKey($export->id)->update([
                        'processed_rows' => $n,
                        'heartbeat_at'   => now(),
                    ]);
                }
            }

            // No rows: still produce one file with headers only
            if ($writer === null) {
                $openPart();
            }
            $writer->close();

            ExportRequest::whereKey($export->id)->update(['heartbeat_at' => now()]);

            // ---- zip ---------------------------------------------------------
            $disk->makeDirectory('exports');
            $zipAbs = $disk->path($zipRel);
            if (file_exists($zipAbs)) {
                unlink($zipAbs);
            }

            $zip = new ZipArchive();
            if ($zip->open($zipAbs, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
                throw new \RuntimeException('Could not create the zip file. Is the PHP zip extension enabled?');
            }
            foreach ($parts as [$abs, $name]) {
                $zip->addFile($abs, $name);
            }
            $zip->close();   // part files must exist until here

            $disk->deleteDirectory($tmpDir);

            $export->update([
                'status'         => 'completed',
                'processed_rows' => $n,
                'file_path'      => $zipRel,
                'completed_at'   => now(),
            ]);
        } catch (\Throwable $e) {
            $disk->deleteDirectory($tmpDir);
            throw $e;
        }
    }

    public function failed(\Throwable $e): void
    {
        ExportRequest::where('id', $this->exportId)
            ->update(['status' => 'failed', 'error' => Str::limit($e->getMessage(), 1000)]);
    }

    /** db column => heading, same order as the HTML table (after ID) */
    private function columns(): array
    {
        $c = [
            'date'          => 'Date',
            'time'          => 'Time',
            'id'            => 'Custom ID',
            'temperature'   => 'House Temperature',
            'temp3_outside' => 'Outside Temperature',
            'temp2_brooder' => 'Brooder Temperature',
            'humidity'      => 'Humidity',
            'humidity2'     => 'Outside Humidity',
        ];

        for ($i = 1; $i <= 12; $i++) {
            $c["fan{$i}_on_time"] = "Fan {$i} On Time";
            $c["fan{$i}_off_time"] = "Fan {$i} Off Time";
        }
        for ($i = 1; $i <= 2; $i++) {
            $c["pad{$i}_on_time"] = "Cool {$i} On Time";
            $c["pad{$i}_off_time"] = "Cool {$i} Off Time";
        }
        for ($i = 1; $i <= 12; $i++) {
            $c["fan{$i}_on_temp"] = "Fan {$i} On Temp";
            $c["fan{$i}_off_temp"] = "Fan {$i} Off Temp";
        }
        for ($i = 1; $i <= 2; $i++) {
            $c["pad{$i}_on_temp"] = "Cool {$i} On Temp";
            $c["pad{$i}_off_temp"] = "Cool {$i} Off Temp";
        }

        return $c;
    }
}
