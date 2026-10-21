<?php

namespace App\Http\Controllers;

use App\Jobs\ExportCnRecordsJob;
use App\Models\ExportRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExportRequestController extends Controller
{
    private const MAX_ACTIVE = 3;

    private function mine(string $shed)
    {
        $farm = $this->globalSetting();

        return ExportRequest::where('user_id', auth()->id())
            ->where('device_id', $farm->{"device_id_{$shed}"});
    }

    public function store(Request $request, string $shed)
    {

        $data = $request->validate([
            'start_date'       => 'required|date',
            'end_date'         => 'required|date|after_or_equal:start_date',
            'interval_minutes' => 'required|integer|in:0,1,5,10,15,30,60',
        ]);

        if ($this->mine($shed)->whereIn('status', ExportRequest::ACTIVE)->count() >= self::MAX_ACTIVE) {
            return response()->json(['message' => 'Too many active exports. Cancel one or wait for it to finish.'], 422);
        }

        $farm = $this->globalSetting();
        $farmName = $farm->name ?? $farm->name ?? config('app.name');

        $export = ExportRequest::create([
            'user_id'          => auth()->id(),
            'device_id'        => $farm->{"device_id_{$shed}"},
            'farm_name'        => $farmName,
            'shed'             => $shed,
            'start_date'       => $data['start_date'],
            'end_date'         => $data['end_date'],
            'interval_minutes' => $data['interval_minutes'],
            'status'           => 'pending',
        ]);

        ExportCnRecordsJob::dispatch($export->id);

        return response()->json(['message' => "Export #{$export->id} queued."]);
    }

    public function status(string $shed)
    {
        $items = $this->mine($shed)->latest('id')->limit(15)->get()->map(function ($e) {
            $stalled = $e->is_stalled;
            $active  = in_array($e->status, ExportRequest::ACTIVE) && !$stalled;

            return [
                'id'         => $e->id,
                'range'      => $e->start_date->toDateString() . ' → ' . $e->end_date->toDateString(),
                'status'     => $stalled ? 'stalled' : ($e->cancel_requested && $e->status === 'processing' ? 'cancelling' : $e->status),
                'progress'   => $e->progress,
                'rows'       => (int) $e->processed_rows,
                'total'      => (int) $e->total_rows,
                'error'      => $e->error,
                'created'    => $e->created_at?->format('d M H:i'),
                'can_cancel' => $active && !$e->cancel_requested,
                'can_retry'  => in_array($e->status, ['failed', 'cancelled']) || $stalled,
                'can_delete' => !$active,
                'download'   => $e->status === 'completed' ? true : false,
                'interval' => $e->interval_minutes ? "every {$e->interval_minutes} min" : 'all records',
            ];
        });

        return response()->json([
            'items'  => $items,
            'active' => $items->contains(fn($i) => in_array($i['status'], ['pending', 'processing', 'cancelling'])),

        ]);
    }

    public function download(string $shed, int $id)
    {
        $export = $this->mine($shed)->where('status', 'completed')->findOrFail($id);
        abort_unless(Storage::disk('local')->exists($export->file_path), 404, 'File no longer exists.');

        return Storage::disk('local')->download($export->file_path);
    }

    public function cancel(string $shed, int $id)
    {
        $export = $this->mine($shed)->findOrFail($id);

        if ($export->status === 'pending' || $export->is_stalled) {
            $export->update(['status' => 'cancelled', 'completed_at' => now()]);
        } elseif ($export->status === 'processing') {
            $export->update(['cancel_requested' => true]); // worker stops at next checkpoint
        } else {
            return response()->json(['message' => 'Nothing to cancel.'], 422);
        }

        return response()->json(['message' => 'Cancel requested.']);
    }

    public function retry(string $shed, int $id)
    {
        $export = $this->mine($shed)->findOrFail($id);

        if (!(in_array($export->status, ['failed', 'cancelled']) || $export->is_stalled)) {
            return response()->json(['message' => 'This export cannot be retried.'], 422);
        }

        $export->deleteFile();
        $export->update([
            'status'           => 'pending',
            'processed_rows'   => 0,
            'total_rows'       => 0,
            'error'            => null,
            'cancel_requested' => false,
            'heartbeat_at'     => null,
            'file_path'        => null,
            'completed_at'     => null,
        ]);

        ExportCnRecordsJob::dispatch($export->id);

        return response()->json(['message' => 'Retry queued.']);
    }

    public function destroy(string $shed, int $id)
    {
        $export = $this->mine($shed)->findOrFail($id);

        if (in_array($export->status, ExportRequest::ACTIVE) && !$export->is_stalled) {
            return response()->json(['message' => 'Cancel the export first.'], 422);
        }

        $export->deleteFile();
        $export->delete();

        return response()->json(['message' => 'Deleted.']);
    }

    public function clearFinished(string $shed)
    {
        $rows = $this->mine($shed)->whereIn('status', ['completed', 'failed', 'cancelled'])->get();

        foreach ($rows as $row) {
            $row->deleteFile();
            $row->delete();
        }

        return response()->json(['message' => $rows->count() . ' removed.']);
    }
}
