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
        Schema::table('wood', function (Blueprint $table) {
            $table->double('source')->nullable();
            $table->double('time')->nullable();
            $table->double('load')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wood', function (Blueprint $table) {
            //
        });
    }
};
