<?php

namespace App\Http\Controllers;

use App\Models\ItemPedido;
use App\Http\Requests\StoreItemPedidoRequest;
use App\Http\Requests\UpdateItemPedidoRequest;

class ItemPedidoController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(ItemPedido::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemPedidoRequest $request)
    {
        try {
            $itemPedido = ItemPedido::create($request->validated());
            return response()->json([
                'message' => 'Item do pedido cadastrado com sucesso!',
                'data' => $itemPedido
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Erro ao cadastrar item do pedido',
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $itemPedido = ItemPedido::with('itemPedidos')->where('id', $id)->first();

            if(!$itemPedido) {
                return response()->json([
                    'message' => 'Item do pedido não encontrado',
                    'data' => $itemPedido
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao buscar item do pedido',
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemPedidoRequest $request, ItemPedido $itemPedido)
    {
        $itemPedido->update($request->validated());

        return response()->json([
            'message' => 'Item do pedido atualizado com sucesso!',
            'data' => $itemPedido
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $itemPedido = ItemPedido::where('id', $id)->first();

            if(!$itemPedido) {
                return response()->json([
                    'message' => 'Item do pedido não encontrado',
                ]);
            }

            $itemPedido->delete();

            return response()->json([
                'message' => 'Item do pedido deletado com sucesso!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao deletar item do pedido',
                'error' => $e->getMessage()
            ]);
        }
    }
}
