<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coach;
use Illuminate\Support\Facades\DB;

class CoachController extends Controller
{
    public function index()
    {
        $coachId = session('fk_coach_actual');

        
        $rutinas = DB::table('rutina as r')
            ->join('cliente as c', 'r.fk_cliente', '=', 'c.pk_cliente')
            ->join('coach as co', 'r.fk_coach', '=', 'co.pk_coach')
            ->join('usuario as u', 'c.fk_usuario', '=', 'u.pk_usuario')
            ->join('persona as p', 'u.fk_persona', '=', 'p.pk_persona')
            ->join('usuario as u2', 'co.fk_usuario', '=', 'u2.pk_usuario')
            ->join('persona as p2', 'u2.fk_persona', '=', 'p2.pk_persona')
            ->where('co.pk_coach', $coachId)
            ->where('r.estatus', 1)
            ->select(
                'r.pk_rutina',
                'r.foto as foto_rutina',
                'r.nombre',
                'r.descripción',
                'r.foto',
                'r.estatus',
                'r.fecha',
                'c.pk_cliente',
                'c.cod_cliente',
                'c.foto as cliente_foto',
                'co.pk_coach',
                'co.cod_coach',
                'u.correo as correo_cliente',
                'p.nombre as nombre_cliente',
                'u2.correo as correo_coach',
                'p2.nombre as nombre_coach'
            )
            ->get();

        return view('indexCoach', compact('rutinas'));
    }
    
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
        ->leftJoin('cliente as c', 'u.pk_usuario', '=', 'c.fk_usuario')
        ->leftJoin('coach as ch', 'u.pk_usuario', '=', 'ch.fk_usuario')
        ->select('u.correo', 'p.nombre', 'u.pk_usuario')
        ->whereNull('c.pk_cliente') 
        ->whereNull('ch.pk_coach')  
        ->get();


      
        return view('registroCoach', compact('datoscoach'));
    }
    public function show($id)
    {
        $rutina = DB::table('rutina as r')
        ->join('cliente as c', 'r.fk_cliente', '=', 'c.pk_cliente')
        ->join('coach as co', 'r.fk_coach', '=', 'co.pk_coach')
        ->join('usuario as u', 'c.fk_usuario', '=', 'u.pk_usuario')
        ->join('persona as p', 'u.fk_persona', '=', 'p.pk_persona')
        ->join('usuario as u2', 'co.fk_usuario', '=', 'u2.pk_usuario')
        ->join('persona as p2', 'u2.fk_persona', '=', 'p2.pk_persona')
        ->where('r.pk_rutina', $id)
        ->select('r.pk_rutina','r.foto as foto_rutina', 'r.nombre', 'r.descripción', 'r.foto', 'r.estatus', 'r.fecha',
                 'c.pk_cliente', 'c.cod_cliente', 'c.foto as cliente_foto', 'co.pk_coach', 'co.cod_coach',
                 'u.correo as correo_cliente', 'p.nombre as nombre_cliente',
                 'u2.correo as correo_coach', 'p2.nombre as nombre_coach')
        ->first();

        return view('DetallesCoachView', ['rutina' => $rutina]);
    }
}


