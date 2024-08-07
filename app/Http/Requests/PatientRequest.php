<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PatientRequest extends FormRequest
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
            'fist_name' => ['required','string','max:30'],
            'last_name' => ['required','string','max:30'],
            //'identification' => ['required','string','max:30',  Rule::unique(table: 'patients', column: 'identification')->ignore(id:request('patient'), idColumn: 'id')],
            //'phone' => ['required','string','max:30'],
            //'email' => ['required','email'],
           // 'address' => ['required','string','max:150'],
           // 'status' => ['required'],
            
        
        ];
    }

  
}
