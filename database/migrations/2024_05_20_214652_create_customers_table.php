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
        Schema::create('customer_types', function (Blueprint $table) {
            $table->id("id_types"); 
            $table->string('name'); 
            $table->timestamps(); 
        });
        

        Schema::create('customers', function (Blueprint $table) {
            $table->string('id_unique_ced')->primary(); // Clave primaria
            $table->string('full_name');
            $table->string('address'); // Dirección del cliente
            $table->string('cell_phone'); // Teléfono del cliente
            $table->string('email');
            $table->unsignedBigInteger('id_types'); // Clave foránea
            $table->text('observations')->nullable();   
            $table->timestamps();
            
            // Definición de la clave foránea
            $table->foreign('id_types')->references('id_types')->on('customer_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_types');
        Schema::dropIfExists('customers');
    }
};
