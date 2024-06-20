<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
                'date' => ['required'],     
                'patient_id' => ['required'],   
                'amount' => ['required'],  
                'status' => ['nullable'],         
            ];
        
    }

    public function messages():array{

        return[
           //'detail_band.required' => __('Debes seleccionar alguna consulta pendiente por pago para continuar'),
           
        ];

    }
}
