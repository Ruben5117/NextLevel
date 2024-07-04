<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
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

            return redirect('/');

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

    public function destroy($pk_usuario)
    {
        try {
            
            $usuario = Usuario::findOrFail($pk_usuario);
         
            $usuario->estatus = 0; 
            
            $usuario->save();
            
            return redirect()->back()->with('success', 'Usuario desactivado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al ejecutar la consulta: ' . $e->getMessage());
        }
    }
    public function showu()
    {
        $usuarios = DB::table('usuario as u')
            ->join('persona as p', 'u.fk_persona', '=', 'p.pk_persona')
            ->select('u.pk_usuario', 'u.correo', 'p.nombre', 'u.fk_persona')
            ->where('u.estatus', '=', 1)
            ->get();

        return view('UsuarioADView', compact('usuarios'));
    }
}

