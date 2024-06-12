<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoUsuario;
class TipousuarioController extends Controller
{
    private function Insertar(Request $request)
    {
        return $request->validate([
            'nombre' => 'required|string|max:10',
         
         
        ]);
    }

    private function saveTipoUsuarioData($validatedData, TipoUsuario $tipo_usuario)
    {
        $tipo_usuario->nombre = $validatedData['nombre'];
        


        $tipo_usuario->save();
    }

    public function store(Request $request)
    {
        $validatedData = $this->Insertar($request);

        try {
            $tipo_usuario = new TipoUsuario();
            $this->saveTipoUsuarioData($validatedData, $tipo_usuario);

            return redirect()->back()->with('success', 'Datos almacenados correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al ejecutar la consulta: ' . $e->getMessage());
        }
    }

    public function index()
    {
        $tipo_usuario = TipoUsuario::all();
        return view('registroTipoUsuario', compact('tipo_usuario'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->Insertar($request);

        try {
            $tipo_usuario = TipoUsuario::findOrFail($id);
            $this->saveTipoUsuarioData($validatedData, $tipo_usuario);

            return redirect()->back()->with('success', 'Datos actualizados correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al ejecutar la consulta: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $tipo_usuario = TipoUsuario::findOrFail($id);
            $tipo_usuario->delete();

            return redirect()->back()->with('success', 'Datos eliminados correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al ejecutar la consulta: ' . $e->getMessage());
        }
    }
}

