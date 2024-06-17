<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->merge(['fk_tipo_usuario' => 1]);

            $validatedData = $request->validate([
                'correo' => 'required|string|max:50',
                'contraseña' => 'required|string|max:100',
                'fk_persona' => 'required|int',
                'fk_tipo_usuario' => 'required|int',
            ]);

            $usuario = new Usuario();

            $usuario->correo = $validatedData['correo'];
            $usuario->contraseña = Hash::make($validatedData['contraseña']);
            $usuario->estatus = 1; 
            $usuario->fk_persona = $validatedData['fk_persona'];
            $usuario->fk_tipo_usuario = $validatedData['fk_tipo_usuario']; 

            $usuario->save();

            return redirect()->back()->with('success', 'Datos almacenados correctamente.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al ejecutar la consulta: ' . $e->getMessage());
        }
    }

    public function index($fk_persona)
    {
        $usuarios = Usuario::all();
        return view('registroUsuario', compact('usuarios', "fk_persona"));
    }

    public function update(Request $request, $id)
    {
        try {
            $usuario = Usuario::findOrFail($id);

            $request->merge(['fk_tipo_usuario' => 1]);

            $validatedData = $request->validate([
                'correo' => 'required|string|max:50',
                'contraseña' => 'required|string|max:100',
                'fk_persona' => 'required|int',
                'fk_tipo_usuario' => 'required|int',
            ]);

            $usuario->correo = $validatedData['correo'];
            $usuario->contraseña = Hash::make($validatedData['contraseña']);
            $usuario->fk_persona = $validatedData['fk_persona'];
            $usuario->fk_tipo_usuario = $validatedData['fk_tipo_usuario'];

            $usuario->save();

            return redirect()->back()->with('success', 'Datos actualizados correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al ejecutar la consulta: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $usuario = Usuario::findOrFail($id);
            $usuario->delete();

            return redirect()->back()->with('success', 'Datos eliminados correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al ejecutar la consulta: ' . $e->getMessage());
        }
    }
}
