<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OfertaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubastaController as SubastaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});


// Home

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/sobre-nosotros', [HomeController::class, 'about'])
    ->name('sobre-nosotros');

Route::get('como-participar', [HomeController::class, 'comoParticipar'])
    ->name('como-participar');

Route::get('calidad', [HomeController::class, 'calidad'])
    ->name('calidad');

Route::get('legal', [HomeController::class, 'legal'])
    ->name('legal');

Route::get('terminos-y-condiciones', [HomeController::class, 'terminos'])
    ->name('terminos');

Route::get('contacto', [HomeController::class, 'contacto'])
    ->name('contacto');


// Subastas y Productos

Route::resource('subastas', SubastaController::class)
    ->only(['index', 'show'])
    ->names('subastas');

Route::post('subastas/publicar-producto/', [SubastaController::class, 'publicarProducto'])
    ->name('subastas.publicar-producto');

Route::resource('productos', ProductoController::class)
    ->only(['show'])
    ->names('productos');

Route::post('productos/ofertar', [ProductoController::class, 'ofertar'])
    ->name('productos.ofertar');


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', DashboardController::class)
        ->middleware('verified')
        ->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
    Route::patch('/profile/direcciones', [DireccionController::class, 'update'])
        ->name('address.update');

    Route::get('/ofertas', [OfertaController::class, 'index'])
        ->name('ofertas.index');
});

require __DIR__.'/auth.php';
