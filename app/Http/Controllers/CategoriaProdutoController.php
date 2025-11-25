<?php

namespace App\Http\Controllers;

use App\Models\CategoriaProduto;
use App\Http\Requests\StoreCategoriaProdutoRequest;
use App\Http\Requests\UpdateCategoriaProdutoRequest;

class CategoriaProdutoController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(CategoriaProduto::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriaProdutoRequest $request)
    {
        try {
            $categoriaProduto = CategoriaProduto::created($request->validate());
            return response()->json([
                'message' => 'Categoria de Produto cadastrada com sucesso!',
                'data' => $categoriaProduto
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao cadastrar Categoria de Produto',
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
            $categoriaProduto = CategoriaProduto::with('categoriaProdutos')->where('id', $id)->first();

            if(!$categoriaProduto) {
                return response()->json([
                    'message' => 'Categoria de Produto não encontrada',
                    'data' => $categoriaProduto
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao buscar Categoria de Produto',
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriaProdutoRequest $request, CategoriaProduto $categoriaProduto)
    {
        $categoriaProduto->update($request->validated());

        return response()->json([
            'message' => 'Categoria de Produto atualizada com sucesso!',
            'data' => $categoriaProduto
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $categoriaProduto = CategoriaProduto::where('id', $id)->first();

            if(!$categoriaProduto) {
                return response()->json([
                    'message' => 'Categoria de Produto não encontrada',
                ]);
            }

            $categoriaProduto->delete();

            return response()->json([
                'message' => 'Categoria de Produto deletada com sucesso!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao deletar Categoria de Produto',
                'error' => $e->getMessage()
            ]);
        }
    }
}