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
        Schema::create('shed2_r_s', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->integer('age')->nullable();
            $table->integer('day_mor')->nullable();
            $table->integer('night_mor')->nullable();
            $table->integer('total_mor')->nullable();
            $table->integer('commulative_mor')->nullable();
            $table->integer('percentage_mor')->nullable();
            $table->integer('remaining')->nullable();
            $table->integer('plan_factor')->nullable();
          
            $table->integer('day_feed')->nullable();
            $table->integer('night_feed')->nullable();
            $table->integer('total_feed')->nullable();
            $table->integer('commulative_feed')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('plan_bags')->nullable();
            $table->integer('fi_bird')->nullable();
            $table->integer('cum_bird')->nullable();
            $table->integer('wi_bird')->nullable();
            $table->integer('dwg')->nullable();
            $table->integer('water_intake')->nullable();
            $table->string('f_e_r')->nullable();
            $table->string('fw')->nullable();
            $table->integer('farm_id')->nullable();
            $table->integer('session_id')->nullable();
            $table->string('water_feed')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shed2_r_s');
    }
};
