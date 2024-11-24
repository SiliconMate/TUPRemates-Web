<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Subasta;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $subastas = Subasta::orderBy('fecha_cierre', 'desc')
                            ->with('categoria')
                            ->take(12)
                            ->get();
        $productos = Producto::where('aprobado', true)->orderBy('created_at', 'asc')->take(12)->get();

        return view('home', compact('subastas', 'productos'));
    }

    public function about()
    {
        return view('sobre-nosotros');
    }
    
    public function comoParticipar()
    {
        return view('como-participar');
    }

    public function calidad()
    {
        return view('calidad');
    }

    public function legal()
    {
        return view('legal');
    }

    public function terminos()
    {
        return view('term-cond');
    }

    public function contacto()
    {
        return view('contacto');
    }
}
