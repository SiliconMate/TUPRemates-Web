<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfertaController extends Controller
{
    public function index()
    {
        // esto servirá para mostrar todas las ofertas que ha hecho el usuario logueado
        $ofertas = Oferta::where('user_id', Auth::user()->id)->with('producto')->paginate(12);

        return view('dashboard.index-ofertas', compact('ofertas'));
    }
}
