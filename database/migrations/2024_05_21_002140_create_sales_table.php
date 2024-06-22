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
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id');
            $table->enum('name_payment', ['Efectivo', 'Transferencia']); // Métodos de pago permitidos
            $table->boolean('status'); // Estado del método de pago
            $table->timestamps();
        });
 
        Schema::create('sale_headers', function (Blueprint $table) {
            $table->id('header_id');
            $table->string('invoice_number')->unique(); // Número de factura único
            $table->date('issue_date'); // Fecha de emisión
            $table->enum('document_type', ['Factura', 'Otro']); // Tipo de documento
            $table->enum('person', ['Consumidor Final', 'Otro']); // Tipo de persona
            $table->string('reference')->nullable(); // Campo opcional de referencia
            $table->unsignedBigInteger('seller_id'); // Vendedor
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade'); // Clave foránea a usuarios
            $table->date('due_date'); // Fecha de vencimiento
            $table->float('total_sale'); // Total de la venta
            $table->float('discount'); // Descuento
            $table->float('Iva'); // IVA
            $table->string('id_unique'); // Clave foránea a clientes
            $table->foreign('id_unique')->references('id_unique')->on('customers')->onDelete('cascade');
            $table->unsignedBigInteger('payment_id'); // Clave foránea a método de pago
            $table->foreign('payment_id')->references('payment_id')->on('payments');
            $table->timestamps();
        
        });

        Schema::create('sale_details', function (Blueprint $table) {
            $table->id('id_detail');
            $table->integer('amount'); // Cantidad
            $table->float('subtotal'); // Subtotal
            $table->float('unit_price'); // Precio unitario
            $table->boolean('status'); // Estado
            $table->unsignedBigInteger('header_id'); // Clave foránea a encabezado de venta
            $table->foreign('header_id')->references('header_id')->on('sale_headers')->onDelete('cascade');
            $table->unsignedBigInteger('id_product'); // Clave foránea a producto
            $table->foreign('id_product')->references('id_product')->on('product')->onDelete('cascade');
            $table->timestamps();
        });}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
        Schema::dropIfExists('sale_headers');
        Schema::dropIfExists('sale_details');
       }
    };
