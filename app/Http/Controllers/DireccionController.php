<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DireccionController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'calle' => 'required|string|max:255',
            'numero' => 'required|string|max:255',
            'piso' => 'nullable|string|max:255',
            'localidad' => 'required|string|max:255',
            'departamento' => 'nullable|string|max:255',
            'provincia' => 'required|string|max:255',
            'codigo_postal' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
        ]);

        if (Auth::user()->direcciones->count() === 0) {
            Auth::user()->direcciones()->create($request->all());
        }

        $direccion = Auth::user()->direcciones->first();

        $direccion->update($request->all());

        return back()->with('status', 'Dirección actualizada correctamente.');
    }
}
