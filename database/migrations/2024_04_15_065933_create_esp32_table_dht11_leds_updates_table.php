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
           
            $table->float('temperature', 10, 2);
            $table->integer('humidity');
            $table->string('status_read_sensor_dht11', 255);
            $table->string('LED_01', 255);
            $table->string('LED_02', 255);
            $table->time('time');
            $table->date('date');
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
