<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    public function show($id){
        $producto = Producto::with('imagenes', 'solicitado_por')->findOrFail($id);

        return view('productos.show', compact('producto'));
    }

    public function create($subasta){
        return view('productos.create', compact('subasta'));
    }

    public function ofertar(Request $request){
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'monto' => 'required|numeric|min:0',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        if($request->monto <= $producto->precio_base || $request->monto <= $producto->usuariosOferentes->max('pivot.monto')){
            return back()->with('status', 'El monto de la oferta debe superar el precio base o a la oferta actual.');
        }

        if ($producto->solicitado_por === Auth::id()) {
            return back()->with('status', 'No puedes ofertar en tu propio producto.');
        }
        
        if ($producto->subasta->fecha_cierre < now()) {
            return back()->with('status', 'La subasta ya terminó.');
        }

        $producto->usuariosOferentes()->attach(Auth::id(), [
            'monto' => $request->monto,
            'forma_pago_id' => 1,
        ]);

        return back()->with('status', 'Oferta realizada con éxito.');
    }
}
