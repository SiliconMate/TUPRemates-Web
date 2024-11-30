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
use Barryvdh\DomPDF\Facade\PDF;

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
                
                if ($producto->ganador) {
                    continue;
                }

                $ganador = Ganador::definirGanador($producto);
                if ($ganador) {
                    Mail::to($ganador->user->email)->send(new InformarGanador($producto));
                }

                $precioVendido = $ganador ? $ganador->monto : 0;
                $usuario = User::find($producto->solicitado_por);

                if ($usuario->persona) {
                    $vendedor = $usuario->persona;
                } else {
                    $vendedor = $usuario->empresa;
                }

                $pdf = PDF::loadView('pdf.factura-vendedor', compact('vendedor', 'producto', 'precioVendido'));

                $pdfOutput = $pdf->output();
                $fileName = 'factura_subasta_' . $producto->id . '.pdf';

                Mail::to($usuario->email)->send(new InformarVendedor($producto, $pdfOutput, $fileName));

                
            }
        }
    }

})->everyTenSeconds();