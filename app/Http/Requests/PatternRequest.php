<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatternRequest extends FormRequest
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
            'models_name' => 'required|string|max:255',
            'id_trademark' => 'required|exists:trademarks,id',
            'status' => 'required|boolean',
        ];
    }
}
