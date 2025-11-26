<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProdutoRequest extends FormRequest
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
            'nome' => 'required|string|max:150',
            'preco' => 'required|numeric|min:0',
            'descricao' => 'nullable|string',
            'categoria_id' => 'required|exists:categorias,id',
            'restaurante_id' => 'required|exists:restaurantes,id',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O nome do produto é obrigatório.',
            'preco.required' => 'O preço do produto é obrigatório.',
            'preco.numeric' => 'O preço do produto deve ser um número válido.',
            'categoria_id.exists' => 'A categoria selecionada é inválida.',
        ];
    }
}
