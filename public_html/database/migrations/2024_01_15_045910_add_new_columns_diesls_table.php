<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('diesels', function (Blueprint $table) {
            $table->double('consumption_shed1')->nullable();
            $table->double('consumption_shed2')->nullable();
            $table->double('consumption_generator')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('diesels', function (Blueprint $table) {
        
        });
    }
};
