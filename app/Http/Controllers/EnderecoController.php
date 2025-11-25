<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Http\Requests\StoreEnderecoRequest;
use App\Http\Requests\UpdateEnderecoRequest;

class EnderecoController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Endereco::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEnderecoRequest $request)
    {
        try {
            $endereco = Endereco::created($request->validate());
            return response()->json([
                'message' => 'Endereço cadastrado com sucesso!',
                'data' => $endereco
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao cadastrar endereço',
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
            $endereco = Endereco::with('enderecos')->where('id', $id)->first();

            if(!$endereco) {
                return response()->json([
                    'message' => 'Endereço não encontrado',
                    'data' => $endereco
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao buscar endereço',
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEnderecoRequest $request, Endereco $endereco)
    {
        $endereco->update($request->validated());

        return response()->json([
            'message' => 'Endereço atualizado com sucesso!',
            'data' => $endereco
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $endereco = Endereco::where('id', $id)->first();

            if(!$endereco) {
                return response()->json([
                    'message' => 'Endereço não encontrado',
                ]);
            }

            $endereco->delete();

            return response()->json([
                'message' => 'Endereço deletado com sucesso!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao deletar endereço',
                'error' => $e->getMessage()
            ]);
        }
    }
}
