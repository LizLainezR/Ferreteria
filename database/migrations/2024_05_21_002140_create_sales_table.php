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
        Schema::create('payment', function (Blueprint $table) {
            $table->id('payment_id');
            $table->string('name_payment');    
            $table->boolean('status');
            $table->timestamps();
          });

          Schema::create('sale_header', function (Blueprint $table) {
            $table->id('header_id');
            $table->float('total_sale');
            $table->float('discount');
            $table->float('Iva');
            $table->string('id_unique_ced');
            $table->unsignedBigInteger('payment_id');
            $table->timestamps();
            $table->foreign('id_unique_ced')->references('id_unique_ced')->on('customers');
            $table->foreign('payment_id')->references('payment_id')->on('payment');
        });

        Schema::create('sale_detail', function (Blueprint $table) {
            $table->id('id_detail');
            $table->integer('amount');
            $table->float('subtotal');
            $table->float('unit_price');
            $table->boolean('status');
            $table->unsignedBigInteger('header_id');
            $table->unsignedBigInteger('id_product');
            $table->timestamps();
            $table->foreign('id_product')->references('id_product')->on('product');
            $table->foreign('header_id')->references('header_id')->on('sale_header');
        });


        

    

     

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
        Schema::dropIfExists('payment');
        Schema::dropIfExists('sale_header');
        Schema::dropIfExists('sale_detail');
       }
    };
