<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
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
        'service_id' => ['required'],
        'made_quantity' => ['required'],
        'service_name' => ['required'],
        'status' => ['required'],
        'status_payment' => ['required'],
    ];
}

public function messages():array{

    return[
       'patient_id.required' => __('Debes agregar un paciente'),
       'service_id.required' => __('Debes Agregar un servicio'),
    ];

}
}
