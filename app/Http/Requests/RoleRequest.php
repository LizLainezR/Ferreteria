<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'role_name' => 'required|string|max:255|unique:role,role_name',
            'status' => 'boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'role_name.required' => 'El nombre del rol es requerido.',
            'role_name.string' => 'El nombre del rol debe ser una cadena de texto.',
            'role_name.max' => 'El nombre del rol no puede tener más de :max caracteres.',
            'role_name.unique' => 'El nombre del rol ya está en uso.',
        ];
    }
}
