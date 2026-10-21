<?php

namespace App\Console\Commands;

use App\Jobs\ExportCnRecordsJob;
use App\Models\ExportRequest;
use Illuminate\Console\Command;

class ExportCnRecords extends Command
{
    protected $signature = 'cn:export {start : Y-m-d} {end : Y-m-d} {--device= : device/board id} {--sync : run now instead of queueing}';
    protected $description = 'Export all controller records between two dates to Excel';

    public function handle(): int
    {
        $device = $this->option('device');
        if (!$device) {
            $this->error('Please pass --device=BOARD_ID');
            return self::FAILURE;
        }

        $export = ExportRequest::create([
            'device_id'  => $device,
            'start_date' => $this->argument('start'),
            'end_date'   => $this->argument('end'),
        ]);

        if ($this->option('sync')) {
            ExportCnRecordsJob::dispatchSync($export->id);
            $export->refresh();
            $this->info("Done: storage/app/{$export->file_path} ({$export->processed_rows} rows)");
        } else {
            ExportCnRecordsJob::dispatch($export->id);
            $this->info("Queued export #{$export->id}. Make sure `php artisan queue:work` is running.");
        }

        return self::SUCCESS;
    }
}