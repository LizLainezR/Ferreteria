<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'remember_me' => ['nullable', 'boolean'],
        ];
    }
    
    public function messages(): array
    {
        return [
            'username.required' => 'El nombre de usuario es requerido.',
            'username.string' => 'El nombre de usuario debe ser una cadena de texto.',
            'username.max' => 'El nombre de usuario no puede tener más de :max caracteres.',
            
            'password.required' => 'La contraseña es requerida.',
            'password.string' => 'La contraseña debe ser una cadena de texto.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            
            'remember_me.boolean' => 'El campo "Recordarme" debe ser verdadero o falso.',
        ];}
    }
