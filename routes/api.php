<?php

use App\Http\Controllers\api\SubastaController as ApiSubastaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// GET /api/subastas
Route::get('/subastas', [ApiSubastaController::class, 'index']);

// GET /api/subastas/{id}/productos
Route::get('/subastas/{subasta}/productos', [ApiSubastaController::class, 'productos']);

// GET /api/subastas/{id}/resultados
Route::get('/subastas/{subasta}/productos-detallado', [ApiSubastaController::class, 'productosDetallado']);