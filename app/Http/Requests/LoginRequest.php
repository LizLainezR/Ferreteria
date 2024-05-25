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
        $reglas = [  
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
            'remember_me' => ['nullable', 'boolean'],
        ];
        
       // dd('Reglas de validación:', $reglas);
        
        return $reglas;
    }

    public function menssages(): array
    {
        $menssages=[
                'username.required' => 'El nombre de usuario es obligatorio.',
                'username.string' => 'El nombre de usuario debe ser una cadena de caracteres.',
                'password.required' => 'La contraseña es obligatoria.',
                'password.string' => 'La contraseña debe ser una cadena de caracteres.',
                'remember_me.boolean' => 'El campo recordarme debe ser verdadero o falso.',
        ];
        return $menssages;
    }
}
