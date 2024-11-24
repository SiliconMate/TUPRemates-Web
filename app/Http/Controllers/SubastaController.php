<?php

namespace App\Http\Controllers;

use App\Models\Subasta;
use Illuminate\Http\Request;

class SubastaController extends Controller
{
    public function index()
    {
        $subastas = Subasta::orderBy('fecha_cierre', 'asc')->with('categoria')->paginate(12);

        return view('subastas.index', compact('subastas'));
    }

    public function show($nombre)
    {
        $subasta = Subasta::where('nombre', $nombre)->firstOrFail();
        $productos = $subasta->productos()->with('imagenes')->paginate(12);

        return view('subastas.show', compact('subasta', 'productos'));
    }
}
