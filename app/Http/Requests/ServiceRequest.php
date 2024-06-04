<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class ServiceRequest extends FormRequest
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
            'name' => ['required','string','max:100', Rule::unique(table: 'services', column: 'name')->ignore(id:request('service'), idColumn: 'id')],
            'price' => ['required','numeric','between:0,9999999999.99',],
            'quantity' => ['required','integer'],
            'status' => ['required'],
            'type' => ['required'],
            'description' => ['required','string','max:250'],
        
        ];
    }

    public function messages():array{

        return[
           'name.unique' => __('El nombre para el servicio ya existe'),
           'price.numeric' => __('Si el precio tiene decimal, utiliza el . (punto) como separador'),
        ];

    }
}
