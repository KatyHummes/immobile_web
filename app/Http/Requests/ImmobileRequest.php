<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImmobileRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric'],
        ];
    }

    public function messages(){
        return [
            'required' => 'Este campo é obrigatório',
            'string' => 'É um campo de texto obrigatório',
            'numeric' => 'É um campo numérico obrigatório',
            'max' => 'O campo deve ter no máximo 50 caracteres',
        ];
    }
}
