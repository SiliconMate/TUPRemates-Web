<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class OfertaController extends Controller
{
    public function store(Request $request, Producto $producto)
    {
        // $request->validate([
        //     'producto_id' => 'required|exists:productos,id',
        //     'monto' => 'required|numeric|min:1',
        // ]);

        // $producto = Producto::findOrFail($request->producto_id);

        // if ($producto->precio_actual >= $request->monto) {
        //     return back()->with('error', 'La cantidad debe ser mayor al precio actual');
        // }

        // $producto->update([
        //     'precio_actual' => $request->cantidad,
        // ]);

        // return back()->with('success', 'Oferta realizada con éxito');
    }
}
