<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coach;
use Illuminate\Support\Facades\DB;

class CoachController extends Controller
{

     function validarDatos(Request $request)
    {
        return $request->validate([
           
            'fk_usuario' => 'required|exists:usuarios,id',
        ]);
    }

     function store(Request $request)
     
    {
        
        try{

            $ultimopkcoach = Coach::orderBy('pk_coach', 'desc')->first();
            $pkCC = $ultimopkcoach ? $ultimopkcoach->pk_coach + 1 : 1;

        $coach = new Coach();
        $coach->cod_coach = 'COD'. $pkCC; 
        $coach->estatus = 1; 
        $coach->fk_usuario = $request->fk_usuario;
        $coach->save();

     
           return redirect()->route('coach.create')->with('success', 'Coach creado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al ejecutar la consulta: ' . $e->getMessage());
        }
    }

    public function create()
    {
    

        $datoscoach = DB::table('usuario as u')
            ->join('persona as p', 'u.fk_persona', '=', 'p.pk_persona')
            ->select( 'u.correo', 'p.nombre', 'u.pk_usuario')
            ->get();

      
        return view('registroCoach', compact('datoscoach'));
    }
}


