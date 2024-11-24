<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function show($id){
        $producto = Producto::with('imagenes', 'solicitado_por')->findOrFail($id);

        return view('productos.show', compact('producto'));
    }
}
