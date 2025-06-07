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
        Schema::create('sma_products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('second_name')->nullable();
            $table->string('slug')->nullable();
            $table->text('details')->nullable();
            $table->decimal('price', 15, 2)->default(0);
            $table->decimal('mrp', 15, 2)->default(0);
            $table->decimal('promotion_price', 15, 2)->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('subcategory_id')->nullable();
            $table->integer('brand')->nullable();
            $table->integer('unit')->nullable();
            $table->integer('quantity')->default(0);
            $table->string('image')->nullable();
            $table->integer('product_status')->nullable();
            $table->timestamp('date_created')->nullable();
            $table->timestamp('status_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sma_products');
    }
};
