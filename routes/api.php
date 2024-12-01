<?php

use App\Http\Controllers\api\SubastaController as ApiSubastaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// GET /api/subastas
Route::get('/subastas', [ApiSubastaController::class, 'index']);

// GET /api/subastas/{id}/
Route::get('/subastas/{id}', [ApiSubastaController::class, 'subastaConProductos']);

// GET /api/subastas/{id}/resultados
Route::get('/producto/{id}', [ApiSubastaController::class, 'productoDetallado']);