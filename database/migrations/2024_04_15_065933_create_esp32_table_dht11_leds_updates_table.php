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
        Schema::create('esp32_table_dht11_leds_update', function (Blueprint $table) {

            $table->id();

            // =========================
            // Sensor Data
            // =========================
            $table->float('temperature', 10, 2);
            $table->integer('humidity');
            $table->string('status_read_sensor_dht11', 255);
            $table->string('LED_01', 255);
            $table->string('LED_02', 255);
            $table->time('time');
            $table->date('date');

            // =========================
            // Fan 1
            // =========================
            $table->string('fan_1_on_temp')->nullable();
            $table->string('fan_1_off_temp')->nullable();
            $table->time('fan_1_on_time')->nullable();
            $table->time('fan_1_off_time')->nullable();

            // =========================
            // Fan 2
            // =========================
            $table->string('fan_2_on_temp')->nullable();
            $table->string('fan_2_off_temp')->nullable();
            $table->time('fan_2_on_time')->nullable();
            $table->time('fan_2_off_time')->nullable();

            // =========================
            // Fan 3
            // =========================
            $table->string('fan_3_on_temp')->nullable();
            $table->string('fan_3_off_temp')->nullable();
            $table->time('fan_3_on_time')->nullable();
            $table->time('fan_3_off_time')->nullable();

            // =========================
            // Fan 4
            // =========================
            $table->string('fan_4_on_temp')->nullable();
            $table->string('fan_4_off_temp')->nullable();
            $table->time('fan_4_on_time')->nullable();
            $table->time('fan_4_off_time')->nullable();

            // =========================
            // Fan 5
            // =========================
            $table->string('fan_5_on_temp')->nullable();
            $table->string('fan_5_off_temp')->nullable();
            $table->time('fan_5_on_time')->nullable();
            $table->time('fan_5_off_time')->nullable();

            // =========================
            // Fan 6
            // =========================
            $table->string('fan_6_on_temp')->nullable();
            $table->string('fan_6_off_temp')->nullable();
            $table->time('fan_6_on_time')->nullable();
            $table->time('fan_6_off_time')->nullable();

            // =========================
            // Fan 7
            // =========================
            $table->string('fan_7_on_temp')->nullable();
            $table->string('fan_7_off_temp')->nullable();
            $table->time('fan_7_on_time')->nullable();
            $table->time('fan_7_off_time')->nullable();

            // =========================
            // Fan 8
            // =========================
            $table->string('fan_8_on_temp')->nullable();
            $table->string('fan_8_off_temp')->nullable();
            $table->time('fan_8_on_time')->nullable();
            $table->time('fan_8_off_time')->nullable();

            // =========================
            // Fan 9
            // =========================
            $table->string('fan_9_on_temp')->nullable();
            $table->string('fan_9_off_temp')->nullable();
            $table->time('fan_9_on_time')->nullable();
            $table->time('fan_9_off_time')->nullable();

            // =========================
            // Fan 10
            // =========================
            $table->string('fan_10_on_temp')->nullable();
            $table->string('fan_10_off_temp')->nullable();
            $table->time('fan_10_on_time')->nullable();
            $table->time('fan_10_off_time')->nullable();

            // =========================
            // Fan 11
            // =========================
            $table->string('fan_11_on_temp')->nullable();
            $table->string('fan_11_off_temp')->nullable();
            $table->time('fan_11_on_time')->nullable();
            $table->time('fan_11_off_time')->nullable();

            // =========================
            // Fan 12
            // =========================
            $table->string('fan_12_on_temp')->nullable();
            $table->string('fan_12_off_temp')->nullable();
            $table->time('fan_12_on_time')->nullable();
            $table->time('fan_12_off_time')->nullable();

            // =========================
            // Heater
            // =========================
            $table->string('heater_on_temp')->nullable();
            $table->string('heater_off_temp')->nullable();
            $table->time('heater_on_time')->nullable();
            $table->time('heater_off_time')->nullable();

            // =========================
            // Cool 1
            // =========================
            $table->string('cool_1_on_temp')->nullable();
            $table->string('cool_1_off_temp')->nullable();
            $table->time('cool_1_on_time')->nullable();
            $table->time('cool_1_off_time')->nullable();

            // =========================
            // Cool 2
            // =========================
            $table->string('cool_2_on_temp')->nullable();
            $table->string('cool_2_off_temp')->nullable();
            $table->time('cool_2_on_time')->nullable();
            $table->time('cool_2_off_time')->nullable();

            // =========================
            // Pad 1
            // =========================
            $table->string('pad_1_on_temp')->nullable();
            $table->string('pad_1_off_temp')->nullable();
            $table->time('pad_1_on_time')->nullable();
            $table->time('pad_1_off_time')->nullable();

            // =========================
            // Pad 2
            // =========================
            $table->string('pad_2_on_temp')->nullable();
            $table->string('pad_2_off_temp')->nullable();
            $table->time('pad_2_on_time')->nullable();
            $table->time('pad_2_off_time')->nullable();

            // =========================
            // Outside Environment
            // =========================
            $table->string('outside_temperature')->nullable();
            $table->string('outside_humidity')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('esp32_table_dht11_leds_update');
    }
};