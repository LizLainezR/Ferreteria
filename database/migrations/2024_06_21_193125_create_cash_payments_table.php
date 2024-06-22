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
        Schema::create('cash_payments', function (Blueprint $table) {
                $table->id('cash_payment_id');
                $table->unsignedBigInteger('sale_header_id'); // Clave foránea a encabezado de venta
                $table->float('amount_received'); // Monto recibido en efectivo
                $table->timestamps();
            
                // Clave foránea a la tabla de encabezados de venta
                $table->foreign('sale_header_id')->references('header_id')->on('sale_headers')->onDelete('cascade');
            });

            Schema::create('transfer_payments', function (Blueprint $table) {
                $table->id('transfer_payment_id');
                $table->unsignedBigInteger('sale_header_id'); // Clave foránea a encabezado de venta
                $table->string('bank_name'); // Nombre del banco
                $table->string('account_number'); // Número de cuenta
                $table->string('transaction_reference'); // Referencia de transacción
                $table->timestamps();
            
                // Clave foránea a la tabla de encabezados de venta
                $table->foreign('sale_header_id')->references('header_id')->on('sale_headers')->onDelete('cascade');
            });
            
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_payments');
        Schema::dropIfExists('transfer_payments');
    }
};
