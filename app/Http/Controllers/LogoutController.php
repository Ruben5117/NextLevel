<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout(); // Cerrar sesión del usuario
        $request->session()->invalidate(); // Invalidar la sesión
        $request->session()->regenerateToken(); // Regenerar el token de sesión

        return redirect('/')->with('status', 'Haz cerrado sesión'); // Redirigir y pasar mensaje flash
    }
}
