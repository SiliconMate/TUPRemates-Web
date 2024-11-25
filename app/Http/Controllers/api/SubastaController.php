<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Subasta;
use Illuminate\Http\Request;

class SubastaController extends Controller
{
    public function index()
    {
        $subastas = Subasta::all();
        return response()->json($subastas);
    }

    public function productos($subastaName)
    {
        $subasta = Subasta::where('nombre', $subastaName)->first();

        if (!$subasta) {
            return response()->json(['error' => 'Subasta no encontrada'], 404);
        }

        $productos = $subasta->productos->load('ganador', 'imagenes');
        return response()->json($productos);
    }

    public function productosDetallado($subastaName)
    {
        $subasta = Subasta::where('nombre', $subastaName)->first();

        if (!$subasta) {
            return response()->json(['error' => 'Subasta no encontrada'], 404);
        }

        $productos = $subasta->productos->load('ganador', 'ganador.user', 'imagenes', 'usuariosOferentes');

        return response()->json($productos);
    }
}
