<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use App\Models\Persona;

class PersonaController extends Controller
{
    private function Insertar(Request $request)
    {
        return $request->validate([
            'nombre' => 'required|string|max:50',
            'fnac' => 'required|date',
            'apellidop' => 'required|string|max:30',
            'apellidom' => 'required|string|max:30',
         
        ]);
    }

    private function savePersonaData($validatedData, Persona $persona)
    {
        $persona->nombre = $validatedData['nombre'];
        $persona->fnac = $validatedData['fnac'];
        $persona->apellidop = $validatedData['apellidop'];
        $persona->apellidom = $validatedData['apellidom'];
        $persona->estatus = 1 ;

        // Calcular la edad
        $fecha_nacimiento = new DateTime($validatedData['fnac']);
        $hoy = new DateTime();
        $persona->edad = $hoy->diff($fecha_nacimiento)->y;

        $persona->save();
    }

    public function store(Request $request)
    {
        $validatedData = $this->Insertar($request);

        try {
            $persona = new Persona();
            $this->savePersonaData($validatedData, $persona);

            return redirect()->back()->with('success', 'Datos almacenados correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al ejecutar la consulta: ' . $e->getMessage());
        }
    }

    public function index()
    {
        $personas = Persona::all();
        return view('registroPersona', compact('personas'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->Insertar($request);

        try {
            $persona = Persona::findOrFail($id);
            $this->savePersonaData($validatedData, $persona);

            return redirect()->back()->with('success', 'Datos actualizados correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al ejecutar la consulta: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $persona = Persona::findOrFail($id);
            $persona->delete();

            return redirect()->back()->with('success', 'Datos eliminados correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al ejecutar la consulta: ' . $e->getMessage());
        }
    }
}
