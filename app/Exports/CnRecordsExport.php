<?php

namespace App\Exports;

use App\Models\CNRecord;
use App\Models\ExportRequest;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomChunkSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CnRecordsExport implements FromQuery, WithHeadings, WithMapping, WithCustomChunkSize, WithStyles
{
    use Exportable;

    private int $processed = 0;

    /** db column => heading, in the same order as the HTML table (after ID) */
    private array $columns = [];

    public function __construct(private ExportRequest $export)
    {
        $this->columns = $this->buildColumns();
    }

    private function buildColumns(): array
    {
        $cols = [
            'date'          => 'Date',
            'time'          => 'Time',
            'id'            => 'Custom ID',
            'temperature'   => 'House Temperature',
            'temp3_outside' => 'Outside Temperature',
            'temp2_brooder' => 'Brooder Temperature',
            'humidity'      => 'Humidity',
            'humidity2'     => 'Outside Humidity',
        ];

        // Fan 1..12 On/Off Time
        for ($i = 1; $i <= 12; $i++) {
            $cols["fan{$i}_on_time"]  = "Fan {$i} On Time";
            $cols["fan{$i}_off_time"] = "Fan {$i} Off Time";
        }

        // Cool 1..2 On/Off Time (pad1, pad2 in DB)
        for ($i = 1; $i <= 2; $i++) {
            $cols["pad{$i}_on_time"]  = "Cool {$i} On Time";
            $cols["pad{$i}_off_time"] = "Cool {$i} Off Time";
        }

        // Fan 1..12 On/Off Temp
        for ($i = 1; $i <= 12; $i++) {
            $cols["fan{$i}_on_temp"]  = "Fan {$i} On Temp";
            $cols["fan{$i}_off_temp"] = "Fan {$i} Off Temp";
        }

        // Cool 1..2 On/Off Temp
        for ($i = 1; $i <= 2; $i++) {
            $cols["pad{$i}_on_temp"]  = "Cool {$i} On Temp";
            $cols["pad{$i}_off_temp"] = "Cool {$i} Off Temp";
        }

        return $cols;
    }

    public function query()
    {
        return CNRecord::query()
            ->select(array_keys($this->columns))
            ->where('board', $this->export->device_id)
            ->whereBetween('date', [
                $this->export->start_date->toDateString(),
                $this->export->end_date->toDateString(),
            ])
            ->orderByDesc('date')
            ->orderByDesc('time')
            ->orderByDesc('id');
    }

    public function headings(): array
    {
        return array_merge(['ID'], array_values($this->columns));
    }

   public function map($row): array
{
    $this->processed++;

    if ($this->processed % 2000 === 0) {
        $q = ExportRequest::whereKey($this->export->id);

        if ($q->value('cancel_requested')) {
            throw new \RuntimeException('Export cancelled by user.');
        }

        ExportRequest::whereKey($this->export->id)->update([
            'processed_rows' => $this->processed,
            'heartbeat_at'   => now(),
        ]);
    }

    $data = [$this->processed];

    foreach (array_keys($this->columns) as $col) {
        $data[] = $row->{$col} ?? '';
    }

    return $data;
}

    public function chunkSize(): int
    {
        return 2000;
    }

    public function styles(Worksheet $sheet)
    {
        return [1 => ['font' => ['bold' => true]]];
    }
}