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
        Schema::create('category', function (Blueprint $table) {
            $table->id('id_category');
            $table->string('category_name');    
            $table->boolean('status');
            $table->timestamps();
        });

        Schema::create('trademark', function (Blueprint $table) {
            $table->id('id_trademark');
            $table->string('trademark_name');   
            $table->boolean('status');
            $table->timestamps(); 
        });

        Schema::create('pattern', function (Blueprint $table) {
            $table->id('id_pattern');
            $table->string('models_name');    
            $table->unsignedBigInteger('id_trademark');
            $table->boolean('status');
            $table->timestamps();
            $table->foreign('id_trademark')->references('id_trademark')->on('trademark');
        });

        Schema::create('product', function (Blueprint $table) {
            $table->id('id_product');
            $table->string('sku')->unique(); // SKU único para cada producto
            $table->string('product_name');
            $table->text('description');
            $table->string('img')->nullable();
            $table->decimal('unit_price', 10, 2);
            $table->integer('stock_quantity');
            $table->integer('stock_max');
            $table->integer('stock_min');
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('pattern_id');
            $table->timestamps();
            $table->foreign('category_id')->references('id_category')->on('category');
            $table->foreign('pattern_id')->references('id_pattern')->on('pattern');
        });}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category');
        Schema::dropIfExists('trademark');
        Schema::dropIfExists('pattern');
        Schema::dropIfExists('product');
      
    }
};
