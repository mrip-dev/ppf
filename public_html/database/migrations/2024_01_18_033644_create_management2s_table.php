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
        Schema::create('management2s', function (Blueprint $table) {
            $table->id();
            $table->double('age')->nullable();
            $table->double('farm_id')->nullable();
            $table->double('temperature')->nullable();
            $table->double('brooding_vents')->nullable();
            $table->double('vent_opening')->nullable();
            $table->double('feeders')->nullable();
            $table->double('pad_length')->nullable();
            $table->double('pad_opening')->nullable();
            $table->time('fan_1_on_t')->nullable();
            $table->time('fan_2_on_t')->nullable();
            $table->time('fan_3_on_t')->nullable();
            $table->time('fan_4_on_t')->nullable();
            $table->time('fan_5_on_t')->nullable();
            $table->time('fan_6_on_t')->nullable();
            $table->time('fan_7_on_t')->nullable();
            $table->time('fan_8_on_t')->nullable();
            $table->time('fan_9_on_t')->nullable();
            $table->time('fan_10_on_t')->nullable();
            $table->time('fan_1_off_t')->nullable();
            $table->time('fan_2_off_t')->nullable();
            $table->time('fan_3_off_t')->nullable();
            $table->time('fan_4_off_t')->nullable();
            $table->time('fan_5_off_t')->nullable();
            $table->time('fan_6_off_t')->nullable();
            $table->time('fan_7_off_t')->nullable();
            $table->time('fan_8_off_t')->nullable();
            $table->time('fan_9_off_t')->nullable();
            $table->time('fan_10_off_t')->nullable();
            $table->integer('cfm')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('management2s');
    }
};
