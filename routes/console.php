<?php

use App\Mail\InformarGanador;
use App\Mail\InformarVendedor;
use App\Models\Ganador;
use App\Models\Producto;
use App\Models\Subasta;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Mail;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {

    $subastas = Subasta::where('estado', 'creada')->get();

    foreach ($subastas as $subasta) {
        if ($subasta->fecha_apertura <= now()) {
            $subasta->estado = 'activa';
            $subasta->save();
        }
    }

    $subastas = Subasta::where('estado', 'activa')->get();

    foreach ($subastas as $subasta) {
        if ($subasta->fecha_cierre <= now()) {
            $subasta->estado = 'cerrada';
            $subasta->save();

            foreach ($subasta->productos as $producto) {
                
                $vendedor = User::find($producto->solicitado_por);
                Mail::to($vendedor)->send(new InformarVendedor($producto));

                if ($producto->ganador) {
                    continue;
                }

                $ganador = Ganador::definirGanador($producto);
                if ($ganador) {
                    Mail::to($ganador->user->email)->send(new InformarGanador($producto));
                }
            }
        }
    }

})->everyThirtySeconds();