<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
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
            'id_unique' => 'required|unique:customers,id_unique|max:255',
            'full_name' => 'required|unique:customers,full_name|string|max:255',
            'business_name' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'cell_phone' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'email' => 'nullable|string|email|max:255',
            'idcustomer_types' => 'required|integer',
            'observations' => 'nullable|string',
         ];
     }
 
     /**
      * Get custom messages for validator errors.
      */
     public function messages(): array
     {
       return [                                                                                                                                                       
            'id_unique.required' => 'The unique ID is required.',
            'id_unique.exists' => 'The  ID does not exist.',
            'full_name.required' => 'The full name is required.',
            'business_name.required' => 'The business name is required.',
            'city.required' => 'The city is required.',
            'address.required' => 'The address is required.',
            'cell_phone.required' => 'The cell phone number is required.',
            'whatsapp.required' => 'The WhatsApp number is required.',
            'email.required' => 'The email is required.',
            'email.email' => 'The email must be a valid email address.',
            'idcustomer_types.required' => 'The customer type ID is required.',
            'idcustomer_types.exists' => 'The selected customer type ID is invalid.',
        ];
     }


     protected function failedValidation(Validator $validator)
     {
         $errors = (new ValidationException($validator))->errors();
 
         throw new HttpResponseException(response()->json([
             'success' => false,
             'message' => 'Validation errors',
             'errors' => $errors,
         ], 422));
     }
}
