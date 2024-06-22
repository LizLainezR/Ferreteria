<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
    public function rules(): array
    {
        return [
        
                'sku' => 'required|string|max:255',
                'product_name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'img' => 'nullable|string|max:255',
                'unit_price' => 'required|numeric|min:0',
                'stock_quantity' => 'required|integer|min:0',
                'stock_max' => 'required|integer|min:0',
                'stock_min' => 'required|integer|min:0',
                'status' => 'boolean',
                'category_id' => 'required|integer|exists:category,id_category',
                'pattern_id' => 'required|integer|exists:pattern,id_pattern',
         ];
    }
}
