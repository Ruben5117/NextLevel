<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'correo' => ['required', 'email'],
            'contraseña' => ['required', 'min:6'],
        ]);

        $usuario = Usuario::where('correo', $request->input('correo'))->first();

        if ($usuario && Hash::check($request->input('contraseña'), $usuario->contraseña)) {
            if ($usuario->estatus == 1) {
                Auth::login($usuario);

                // Verificar el tipo de usuario y redirigir en consecuencia
                if ($usuario->fk_tipo_usuario == 2) {
                    return redirect()->intended('/admin'); 
                }

                return redirect()->intended('/welcome');
            } else {
                return back()->withErrors([
                    'correo' => 'El usuario no está activo.',
                ]);
            }
        }

        return back()->withErrors([
            'correo' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);
    }
}
