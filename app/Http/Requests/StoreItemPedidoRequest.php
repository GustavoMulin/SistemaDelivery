<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemPedidoRequest extends FormRequest
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
            'pedido_id' => 'required|exists:pedidos,id',
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
            'preco' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'pedido_id.required' => 'O pedido é obrigatório.',
            'produto_id.required' => 'O produto é obrigatório.',
        ];
    }
}