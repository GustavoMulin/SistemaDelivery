<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Http\Requests\StoreProdutoRequest;
use App\Http\Requests\UpdateProdutoRequest;

class ProdutoController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Produto::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProdutoRequest $request)
    {
        try {
            $produto = Produto::create($request->validated());
            return response()->json([
                'message' => 'Produto cadastrado com sucesso!',
                'data' => $produto
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao cadastrar produto',
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
            $produto = Produto::with('produtos')->where('id', $id)->first();

            if(!$produto) {
                return response()->json([
                    'message' => 'Produto não encontrado',
                    'data' => $produto
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao buscar produto',
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProdutoRequest $request, Produto $produto)
    {
        $produto->update($request->validated());

        return response()->json([
            'message' => 'Produto atualizado com sucesso!',
            'data' => $produto
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $produto = Produto::where('id', $id)->first();

            if(!$produto) {
                return response()->json([
                    'message' => 'Produto não encontrado',
                ]);
            }

            $produto->delete();

            return response()->json([
                'message' => 'Produto deletado com sucesso!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao deletar produto',
                'error' => $e->getMessage()
            ]);
        }
    }
}