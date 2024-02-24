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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'street' => 'required|string|max:255',
            'number' => 'required|numeric',
            'neighborhood' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|',
            // 'photos' => 'required|array',
            // 'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages(){
        return [
            'required' => 'Este campo é obrigatório',
            'string' => 'É um campo de texto obrigatório',
            'numeric' => 'É um campo numérico obrigatório',
            'max' => 'O campo deve ter no máximo 255 caracteres',
            'photos.*.image' => 'O arquivo deve ser uma imagem',
            'photos.*.mimes' => 'O arquivo deve ser uma imagem',
            'photos.*.max' => 'O arquivo deve ter no máximo 2MB',
        ];
    }
}
