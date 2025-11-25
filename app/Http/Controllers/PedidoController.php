<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Http\Requests\StorePedidoRequest;
use App\Http\Requests\UpdatePedidoRequest;

class PedidoController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Pedido::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePedidoRequest $request)
    {
        try {
            $pedido = Pedido::create($request->validated());
            return response()->json([
                'message' => 'Pedido cadastrado com sucesso!',
                'data' => $pedido
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao cadastrar pedido',
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
            $pedido = Pedido::with('pedidos')->where('id', $id)->first();

            if(!$pedido) {
                return response()->json([
                    'message' => 'Pedido não encontrado',
                    'data' => $pedido
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao buscar pedido',
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePedidoRequest $request, Pedido $pedido)
    {
        $pedido->update($request->validated());

        return response()->json([
            'message' => 'Pedido atualizado com sucesso!',
            'data' => $pedido
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $pedido = Pedido::where('id', $id)->first();

            if(!$pedido) {
                return response()->json([
                    'message' => 'Pedido não encontrado',
                ]);
            }

            $pedido->delete();

            return response()->json([
                'message' => 'Pedido deletado com sucesso!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao deletar pedido',
                'error' => $e->getMessage()
            ]);
        }
    }
}
