<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ExportRequest extends Model
{
    protected $guarded = [];

    protected $casts = [
        'start_date'       => 'date',
        'end_date'         => 'date',
        'completed_at'     => 'datetime',
        'heartbeat_at'     => 'datetime',
        'cancel_requested' => 'boolean',
    ];

    public const ACTIVE        = ['pending', 'processing'];
    public const STALL_MINUTES = 5;

    public function getProgressAttribute(): int
    {
        if ($this->status === 'completed') return 100;

        return $this->total_rows > 0
            ? (int) min(100, round($this->processed_rows / $this->total_rows * 100))
            : 0;
    }

    /** Marked "processing" but no heartbeat for a while: the worker or request died. */
    public function getIsStalledAttribute(): bool
    {
        if ($this->status !== 'processing') return false;

        $last = $this->heartbeat_at ?? $this->updated_at;

        return $last && $last->lt(now()->subMinutes(self::STALL_MINUTES));
    }

    public function deleteFile(): void
    {
        if ($this->file_path) {
            Storage::disk('local')->delete($this->file_path);
        }
    }
}