<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request, $rutinaId)
    {
        $validatedData = $request->validate([
            'comentario' => 'required|string',
        ]);

       
        $tipoUsuario = auth()->user()->fk_tipo_usuario;

       
        $comentario = Comentario::create([
            'comentario' => $validatedData['comentario'],
            'estatus' => 1,
            'fecha' => Carbon::now(),
            'fk_usuario' => auth()->id(),  
            'fk_rutina' => $rutinaId,
        ]);

        if ($tipoUsuario == 1) {
            
            return redirect()->route('cliente.show', ['id' => $rutinaId])->with('success', 'Comentario guardado correctamente');
        } elseif ($tipoUsuario == 4) {
          
            return redirect()->route('coach.show', ['id' => $rutinaId])->with('success', 'Comentario guardado correctamente');
        } else {
           
            return redirect()->route('/')->with('error', 'No se pudo determinar la ruta adecuada para redireccionar.');
        }
    }
    public function edit($id)
    {
        $rutina = Comentario::findOrFail($id);
        return view('DetallesCoachView', compact('comentario'));
    }

    public function update(Request $request, $id)
    {
        try {
            $comentario = Comentario::findOrFail($id);


            $validatedData = $request->validate([
               
                'comentario' => 'nullable|string',
               
            ]);
           
            $comentario -> comentario = $validatedData['comentario'];
          
            
            $comentario->save();

            return redirect()->back()->with('success', 'Datos actualizados correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al ejecutar la consulta: ' . $e->getMessage());
        }
    }

    public function destroy($pk_comentario)
{
    try {
       
        $comentario = Comentario::findOrFail($pk_comentario);


        $comentario->delete();

  
        return redirect()->back()->with('success', 'Comentario eliminado correctamente.');
    } catch (\Exception $e) {
  
        return redirect()->back()->with('error', 'Error al ejecutar la consulta: ' . $e->getMessage());
    }
}

    
}
