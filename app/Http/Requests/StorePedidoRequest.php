<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePedidoRequest extends FormRequest
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
            'restaurante_id' => 'required|exists:restaurantes,id',
            'endereco_id' => 'required|exists:enderecos,id',
            'status' => 'required|string|in:pendente,confirmado,em_preparo,em_transito,entregue,cancelado',
            'total' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'O usuário é obrigatório.',
            'restaurante_id.exists' => 'O restaurante selecionado não existe.',
            'total.required' => 'O total do pedido é obrigatório.',
        ];
    }
}
