<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoriaProdutoRequest extends FormRequest
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
            'nome' => 'required|string|max:100',
            'restaurante_id' => 'required|exists:restaurantes,id',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O nome da categoria é obrigatório.',
            'restaurante_id.required' => 'O restaurante é obrigatório.',
            'restaurante_id.exists' => 'O restaurante informado não existe.',
        ];
    }
}
