<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Subasta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubastaController extends Controller
{
    public function index()
    {
        $subastas = Subasta::where('fecha_cierre', '>', now())
                            ->orderBy('fecha_cierre', 'asc')
                            ->with('categoria')
                            ->paginate(12);

        return view('subastas.index', compact('subastas'));
    }

    public function show($nombre)
    {
        $subasta = Subasta::where('nombre', $nombre)->firstOrFail();
        $productos = $subasta->productos()->where('aprobado', 1)->with('imagenes')->paginate(12);

        return view('subastas.show', compact('subasta', 'productos'));
    }

    public function publicarProducto(Request $request)
    {
        $subasta = Subasta::findOrFail($request->subasta_id);
        if (Auth::user() === null || $subasta->fecha_cierre < now()) {
            return back()->with('status', 'Debes iniciar sesión para publicar un producto o la subasta ya terminó.');
        }

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio_base' => 'required|numeric|min:0',
            'subasta_id' => 'required|exists:subastas,id',
            'imagenes' => 'required|array',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $producto = Producto::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'precio_base' => $request->precio_base,
            'subasta_id' => $request->subasta_id,
            'solicitado_por' => Auth::id(),
        ]);

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $nombre = Auth::id() . '-' . $producto->id . '.' . $imagen->extension();
                $imagen->storeAs('productos', $nombre, 'azure');
                $producto->imagenes()->create(['url' => $nombre]);
            }
        }

        return back()->with('status', 'Producto solicitado correctamente. Espera su revisión.');

    }
}
