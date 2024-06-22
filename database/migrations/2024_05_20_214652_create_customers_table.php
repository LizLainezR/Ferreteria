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
            $table->id("idcustomer_types"); 
            $table->string('name'); 
            $table->boolean('status');
            $table->timestamps(); 
        });
        
        
        Schema::create('customers', function (Blueprint $table) {
            $table->string('id_unique')->primary(); 
            $table->string('full_name');
            $table->string('business_name');
            $table->string('city');
            $table->string('address'); // Dirección del cliente
            $table->string('cell_phone'); // Teléfono del cliente
            $table->string('whatsapp'); // Teléfono del cliente
            $table->string('email');
            $table->unsignedBigInteger('idcustomer_types'); // Clave foránea
            $table->text('observations')->nullable();   
            $table->boolean('status');
            $table->timestamps();
            $table->foreign('idcustomer_types')->references('idcustomer_types')->on('customer_types')->onDelete('cascade');
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
