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
            $table->string('product_name');
            $table->string('description');
            $table->binary('img');
            $table->float('cost');
            $table->integer('stock_quantity');
            $table->integer('stock_max');
            $table->integer('stock_min');
            $table->boolean('status');
            $table->unsignedBigInteger('id_category');
            $table->unsignedBigInteger('id_pattern');
            $table->timestamps();
            $table->foreign('id_category')->references('id_category')->on('category');
            $table->foreign('id_pattern')->references('id_pattern')->on('pattern');
           
        });


    }

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
