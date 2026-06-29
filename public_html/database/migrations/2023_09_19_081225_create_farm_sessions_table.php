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
        Schema::create('farm_sessions', function (Blueprint $table) {
            $table->id();
            $table->integer('farm_id')->nullable();
            $table->integer('session_id')->nullable();
            $table->integer('str_shed1')->nullable();
            $table->integer('str_shed2')->nullable();
            $table->date('starting_date')->nullable();
            $table->date('ending_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farm_sessions');
    }
};
