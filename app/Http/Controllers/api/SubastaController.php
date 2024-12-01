<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Subasta;
use Illuminate\Http\Request;

class SubastaController extends Controller
{
    public function index()
    {
        $subastas = Subasta::all();
        return response()->json($subastas);
    }

    public function subastaConProductos($id)
    {
        $subasta = Subasta::where('id', $id)->first();
        $subasta->load('productos.imagenes');

        if (!$subasta) {
            return response()->json(['error' => 'Subasta no encontrada'], 404);
        }

        return response()->json($subasta);
    }

    public function productoDetallado($id)
    {
        $producto = Producto::where('id', $id)->first();
        $producto->load('imagenes', 'subasta', 'ganador', 'ganador.user', 'usuariosOferentes');

        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrada'], 404);
        }

        return response()->json($producto);
    }
}
