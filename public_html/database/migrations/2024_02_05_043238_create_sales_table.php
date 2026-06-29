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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('comp_name')->nullable();
            $table->string('type')->nullable();
            $table->string('spec_name')->nullable();
            $table->string('specs')->nullable();
            $table->string('unit')->nullable();
            $table->string('from')->nullable();
            $table->string('bill_no')->nullable();
            $table->string('category')->nullable();
            $table->string('driver')->nullable();
            $table->string('price')->nullable();
            $table->string('doc_no')->nullable();
            $table->double('amount')->nullable();
            $table->double('quantity')->nullable();
            $table->double('farm_id')->nullable();
            $table->double('session_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
