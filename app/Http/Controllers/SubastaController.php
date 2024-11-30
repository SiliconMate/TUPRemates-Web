<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Subasta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SubastaController extends Controller
{
    public function index(Request $request)
    {
        $query = Subasta::query();

        if ($request->has('query') && $request->query('query') != null) {
            $query->where('nombre', 'like', '%' . $request->query('query') . '%');
        }

        if ($request->has('categoria') && $request->query('categoria') != null) {
            $query->where('categoria_id', $request->categoria);
        }

        if ($request->has('estado') && $request->query('estado') != null) {
            $query->where('estado', $request->query('estado'));
        }

        $subastas = $query->orderBy('fecha_cierre', 'asc')->paginate(12);

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

        if (!Auth::user()->hasVerifiedEmail()) {
            return back()->with('status', 'Debes verificar tu correo electrónico para poder publicar un producto.');
        }

        if (Auth::user()->direcciones->count() === 0) {
            return back()->with('status', 'Debes tener un domicilio registrado para poder publicar un producto. Registra uno en tu perfil.');
        }

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio_base' => 'required|numeric|min:0',
            'subasta_id' => 'required|exists:subastas,id',
            'imagenes' => 'required|array',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'terminos' => 'accepted',
            'acuerdo' => 'accepted',
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
                $nombreOriginal = $imagen->getClientOriginalName();
                $nombreSlug = Str::slug(pathinfo($nombreOriginal, PATHINFO_FILENAME)) . '.' . $imagen->extension();
                $nombre = Auth::id() . '-' . $producto->id . '-' . $nombreSlug;
                $imagen->storeAs('productos', $nombre, 'azure');
                $producto->imagenes()->create(['url' => $nombre]);
            }
        }

        return back()->with('status', 'Producto solicitado correctamente. Espera su revisión.');

    }
}
