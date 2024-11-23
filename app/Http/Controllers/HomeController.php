<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Subasta;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $subastas = Subasta::orderBy('fecha_cierre', 'asc')->with('categoria')->take(12)->get();

        return view('home', compact('subastas'));
    }

    public function about()
    {
        return view('sobre-nosotros');
    }
    
    public function comoParticipar()
    {
        return view('como-participar');
    }
}
