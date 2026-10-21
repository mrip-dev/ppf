<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('export_requests', function (Blueprint $table) {
            $table->boolean('cancel_requested')->default(false)->after('error');
            $table->timestamp('heartbeat_at')->nullable()->after('cancel_requested');
        });

        // enum -> string so 'cancelled' is allowed
        DB::statement("ALTER TABLE export_requests MODIFY status VARCHAR(20) NOT NULL DEFAULT 'pending'");
    }

    public function down(): void
    {
        Schema::table('export_requests', function (Blueprint $table) {
            $table->dropColumn(['cancel_requested', 'heartbeat_at']);
        });
    }
};