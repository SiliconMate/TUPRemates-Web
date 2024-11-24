<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->type === 'fisica') {
            $request->validate([
                'name' => ['required', 'string', 'max:255', 'unique:'.User::class],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'telefono' => ['required', 'string', 'max:255'],
                'nombre' => ['required', 'string', 'max:255'],
                'apellido' => ['required', 'string', 'max:255'],
                'tipo_documento' => ['required', 'string', 'max:255'],
                'numero_documento' => ['required', 'string', 'max:255'],
                'sexo' => ['required', 'string', 'max:255'],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'telefono' => $request->telefono,
            ]);

            $user->persona()->create([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'tipo_documento' => $request->tipo_documento,
                'numero_documento' => $request->numero_documento,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'sexo' => $request->sexo,
            ]);

            event(new Registered($user));

            Auth::login($user);

            return redirect(route('home', absolute: false));
        } else {
            $request->validate([
                'name' => ['required', 'string', 'max:255', 'unique:'.User::class],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'telefono' => ['required', 'string', 'max:255'],
                'cuit' => ['required', 'string', 'max:255', 'unique:'.Empresa::class],
                'tipo_sociedad' => ['required', 'string', 'max:255'],
                'razon_social' => ['required', 'string', 'max:255'],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'telefono' => $request->telefono,
            ]);

            $user->empresa()->create([
                'razon_social' => $request->razon_social,
                'cuit' => $request->cuit,
                'tipo_sociedad' => $request->tipo_sociedad,
            ]);

            event(new Registered($user));

            Auth::login($user);

            return redirect(route('home', absolute: false));
        }

        return redirect()->route('register')->withErrors(['registration' => 'There was an error with your registration. Please try again.']);
    }
}
