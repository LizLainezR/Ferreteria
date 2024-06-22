<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
        'issue_date' => 'required|date',
        'document_type' => 'required|in:Factura,Otro',
        'person' => 'required|in:Consumidor Final,Otro',
        'reference' => 'nullable|string',
        'seller_id' => 'required|exists:users,id',
        'due_date' => 'required|date',
        'total_sale' => 'required|numeric',
        'discount' => 'required|numeric',
        'Iva' => 'required|numeric',
        'id_unique' => 'required|exists:customers,id_unique',
        'payment_id' => 'required|exists:payments,id',
        // Agregar validaciones específicas para los detalles de transferencia
        'bank_name' => 'nullable|required_if:payment_id,2|string',
        'account_number' => 'nullable|required_if:payment_id,2|string',
        'transaction_reference' => 'nullable|required_if:payment_id,2|string',
        ];
    }



}