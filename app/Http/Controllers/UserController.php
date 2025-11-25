<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $user = User::created($request->validate());
            return response()->json([
                'message' => 'Usuário cadastrado com sucesso!',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao cadastrar usuário',
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
            $user = User::with('users')->where('id', $id)->first();

            if(!$user) {
                return response()->json([
                    'message' => 'Usuário não encontrado',
                    'data' => $user
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao buscar usuário',
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());

        return response()->json([
            'message' => 'Usuário atualizado com sucesso!',
            'data' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $user = User::where('id', $id)->first();

            if(!$user) {
                return response()->json([
                    'message' => 'Usuário não encontrado',
                ]);
            }

            $user->delete();

            return response()->json([
                'message' => 'Usuário deletado com sucesso!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao deletar usuário',
                'error' => $e->getMessage()
            ]);
        }
    }
}
