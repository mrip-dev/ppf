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
        Schema::table('protien_farms', function (Blueprint $table) {
            $table->string('shed_length')->nullable();
            $table->string('shed_height')->nullable();
            $table->string('shed_width')->nullable();
            $table->string('fan_capacity')->nullable();
            $table->string('no_of_vents')->nullable();
            $table->string('length_of_vent')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('protien_farms', function (Blueprint $table) {
            //
        });
    }
};
