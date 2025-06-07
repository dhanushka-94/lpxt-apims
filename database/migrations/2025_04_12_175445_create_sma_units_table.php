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
        Schema::create('sma_units', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('base_unit')->nullable();
            $table->string('operator')->nullable();
            $table->decimal('operation_value', 15, 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sma_units');
    }
};
