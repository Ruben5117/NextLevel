<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

            $cliente = DB::table('cliente')
            ->join('usuario', 'cliente.fk_usuario', '=', 'usuario.pk_usuario')
            ->where('usuario.pk_usuario', $usuario->pk_usuario)
            ->select('cliente.pk_cliente')
            ->first(); 

            $coach = DB::table('coach')
                ->join('usuario', 'coach.fk_usuario', '=', 'usuario.pk_usuario')
                ->where('usuario.pk_usuario', $usuario->pk_usuario)
                ->select('coach.pk_coach')
                ->first(); 
            session([
                'id' => $usuario->pk_usuario,
                'fk_tipo_usuario' => $usuario->fk_tipo_usuario,
                //'fk_coach_actual' => $coach ? $coach->pk_coach : null
            ]);

            if ($coach) {
                session(['fk_coach_actual' => $coach->pk_coach]);
        
        }
        if ($cliente) {
            session(['fk_cliente_actual' => $cliente->pk_cliente]);
    
    }
            if ($usuario->estatus == 1) {
                Auth::login($usuario);

           
                if ($usuario->fk_tipo_usuario == 2) {
                    return redirect()->intended('/admin'); 
                }
                if ($usuario->fk_tipo_usuario == 4) {
                    return redirect()->intended('/coach'); 
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
