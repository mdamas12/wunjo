<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BranchesRequest extends FormRequest
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
            'name' => ['required','string','max:100', Rule::unique(table: 'branches', column: 'name')->ignore(id:request('branch'), idColumn: 'id')],
            'address' => ['required','string','max:100'],
            'email' => ['required','email'],
            'phone' => ['required','string','max:100'],
            'status' => ['required'],
            'description' => ['required','string','max:100'],
        
        ];
    }

    public function messages():array{

        return[
           'name.unique' => __('El nombre para la sede ya existe')
        ];

    }
}
