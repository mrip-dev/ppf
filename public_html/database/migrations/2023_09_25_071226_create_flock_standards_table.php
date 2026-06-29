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
        Schema::create('flock_standards', function (Blueprint $table) {
            $table->id();
            $table->double('day')->nullable();
            $table->double('feed')->nullable();
            $table->integer('farm_id')->nullable();
            $table->integer('session_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flock_standards');
    }
};
