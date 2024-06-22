<?php

namespace App\Http\Controllers;

use App\Models\Sale_header;
use App\Models\Sale_details;
use App\Models\cash_payments;
use App\Models\transfer_payments;
use Illuminate\Http\Request;

class SalesContoller extends Controller
{
   
   
    public function createInvoice(Request $request)
    {
        // Validar la solicitud
        $data = $request->validate([
            'issue_date' => 'required|date',
            'document_type' => 'required|string|in:Factura,Otro',
            'person' => 'required|string|in:Consumidor Final,Otro',
            'reference' => 'nullable|string',
            'seller_id' => 'required|exists:users,id',
            'due_date' => 'required|date',
            'total_sale' => 'required|numeric',
            'discount' => 'required|numeric',
            'Iva' => 'required|numeric',
            'id_unique' => 'required|exists:customers,id_unique',
            'payment_id' => 'required|exists:payments,payment_id',
            'details' => 'required|array',
            'details.*.id_product' => 'required|exists:product,id_product',
            'details.*.amount' => 'required|integer',
            'details.*.unit_price' => 'required|numeric',
            'details.*.subtotal' => 'required|numeric',
            'payment_method' => 'required|string|in:cash,transfer',
            'cash_payment.amount_received' => 'required_if:payment_method,cash|numeric',
            'transfer_payment.bank_name' => 'required_if:payment_method,transfer|string',
            'transfer_payment.account_number' => 'required_if:payment_method,transfer|string',
            'transfer_payment.transaction_reference' => 'required_if:payment_method,transfer|string',
            
        
        ]);

        try {
            // Crear el encabezado de la venta
            $saleHeader = Sale_header::create($data);

            // Crear los detalles de la venta
            foreach ($data['details'] as $detail) {
                $detail['header_id'] = $saleHeader->header_id;
                Sale_details::create($detail);
            }

            // Crear el pago correspondiente
            if ($data['payment_method'] === 'cash') {
                $cashPayment = new Cash_payments($data['cash_payment']);
                $cashPayment->sale_header_id = $saleHeader->header_id;
                $cashPayment->save();
            } elseif ($data['payment_method'] === 'transfer') {
                $transferPayment = new Transfer_payments($data['transfer_payment']);
                $transferPayment->sale_header_id = $saleHeader->header_id;
                $transferPayment->save();
            }

            return response()->json([
                'message' => 'Factura creada exitosamente',
                'sale_header' => $saleHeader,
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error creating invoice', 'message' => $e->getMessage()], 500);
        }
    }

   
}
