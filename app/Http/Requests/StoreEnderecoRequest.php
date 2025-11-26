<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEnderecoRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'rua' => 'required|string|max:150',
            'numero' => 'required|string|max:20',
            'bairro' => 'required|string|max:100',
            'cidade' => 'required|string|max:100',
            'estado' => 'required|string|max:100',
            'cep' => 'required|string|max:9',
        ];
    }

    public function messages()
    {
        return [
            'usuario_id.required' => 'O usuário é obrigatório.',
            'usuario_id.exists' => 'O usuário informado não existe.',
            'rua.required' => 'A rua é obrigatório.',
            'cep.required' => 'O CEP é obrigatório.',
        ];
    }
}
