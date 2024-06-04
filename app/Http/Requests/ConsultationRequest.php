<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ConsultationRequest extends FormRequest
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
        'branch_id' => ['required'],
        'date' => ['required'],
        'hour' => ['required'],
        'patient_id' => ['required'],
        'employee_id' => ['required'],
        'status' => ['required'],
        'status_payment' => ['required'],
    
    ];
}

public function messages():array{

    return[
       'patient_id.required' => __('Debes agregar un paciente'),
       'employee_id.unique' => __('Debes Asignar la consulta'),
    ];

}
}
