<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroRequest extends FormRequest
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
            'code' => 'required|unique:users,code|string|max:255',
            'cedula' => 'required|string|min:10|max:13',
            'username' => 'required|unique:users,username|alpha_dash|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8|regex:/[A-Za-z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/', // Añadidas reglas de complejidad para la contraseña
            'id_role' => 'required|exists:role,id_role',
            'status' => 'boolean',
        ];
    }
    
    public function messages(): array{
    return [
        'username.required' => 'El nombre de usuario es requerido.',
        'username.unique' => 'El nombre de usuario ya está en uso.',
        'username.alpha_dash' => 'El nombre de usuario solo puede contener letras, números, guiones y guiones bajos.',
        'username.max' => 'El nombre de usuario no puede tener más de :max caracteres.',
        
        'email.required' => 'El correo electrónico es requerido.',
        'email.email' => 'Debe ingresar un correo electrónico válido.',
        'email.unique' => 'Este correo electrónico ya está registrado.',
        'email.max' => 'El correo electrónico no puede tener más de :max caracteres.',
        
        'password.required' => 'La contraseña es requerida.',
        'password.string' => 'La contraseña debe ser una cadena de texto.',
        'password.min' => 'La contraseña debe tener al menos :min caracteres.',
        'password.regex' => 'La contraseña debe contener al menos una letra, un número y un carácter especial.',
        
        'id_role.required' => 'El rol es requerido.',
        'id_role.exists' => 'El rol seleccionado no es válido.',
    ];
}


}
