<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRestauranteRequest extends FormRequest
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
            'descricao' => 'nullable|string|max:255',
            'endereco' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O nome do restaurante é obrigatório.',
            'endereco.required' => 'O endereço do restaurante é obrigatório.',
        ];
    }
}
