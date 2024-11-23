<?php

namespace App\Http\Controllers;

use App\Models\Subasta;
use Illuminate\Http\Request;

class SubastaController extends Controller
{
    public function index()
    {
        $subastas = Subasta::orderBy('fecha_cierre', 'asc')->with('categoria')->paginate(3);

        return view('subastas.index', compact('subastas'));
    }

    public function show($nombre)
    {
        $subasta = Subasta::where('nombre', $nombre)->with('productos')->firstOrFail();

        return view('subastas.show', compact('subasta'));
    }
}
