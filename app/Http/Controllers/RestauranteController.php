<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;
use App\Http\Requests\StoreRestauranteRequest;
use App\Http\Requests\UpdateRestauranteRequest;

class RestauranteController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Restaurante::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestauranteRequest $request)
    {
        try {
            $restaurante = Restaurante::create($request->validated());
            return response()->json([
                'message' => 'Restaurante cadastrado com sucesso!',
                'data' => $restaurante
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao cadastrar restaurante',
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
            $restaurante = Restaurante::with('restaurantes')->where('id', $id)->first();

            if (!$restaurante) {
                return response()->json([
                    'message' => 'Restaurante não encontrado',
                    'data' => $restaurante
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao buscar restaurante',
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRestauranteRequest $request, Restaurante $restaurante)
    {
        $restaurante->update($request->validated());

        return response()->json([
            'message' => 'Restaurante atualizado com sucesso!',
            'data' => $restaurante
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $restaurante = Restaurante::where('id', $id)->first();

            if (!$restaurante) {
                return response()->json([
                    'message' => 'Restaurante não encontrado',
                ]);
            }

            $restaurante->delete();

            return response()->json([
                'message' => 'Restaurante deletado com sucesso!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao deletar restaurante',
                'error' => $e->getMessage()
            ]);
        }
    }
}
