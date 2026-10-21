<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('export_requests', function (Blueprint $table) {
            $table->unsignedSmallInteger('interval_minutes')->default(0)->after('end_date'); // 0 = all records
            $table->string('farm_name')->nullable()->after('device_id');
            $table->string('shed')->nullable()->after('farm_name');
        });
    }

    public function down(): void
    {
        Schema::table('export_requests', function (Blueprint $table) {
            $table->dropColumn(['interval_minutes', 'farm_name', 'shed']);
        });
    }
};