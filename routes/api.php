<?php

use App\Http\Controllers\CategoriaProdutoController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\RestauranteController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('restaurantes', RestauranteController::class);
    Route::apiResource('produtos', ProdutoController::class);
    Route::apiResource('pedidos', PedidoController::class);
    Route::apiResource('itemspedidos', PedidoController::class);
    Route::apiResource('enderecos', EnderecoController::class);
    Route::apiResource('categoriaprodutos', CategoriaProdutoController::class);
});
