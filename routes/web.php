<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubastaController;
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

// Subastas

Route::resource('subastas', SubastaController::class)
    ->only(['index', 'show'])
    ->names('subastas');


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
});

require __DIR__.'/auth.php';
