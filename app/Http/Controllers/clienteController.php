<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Comentario;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    public function index()
    {
        
        $clienteId = session('fk_cliente_actual');
        $rutinasC = DB::table('rutina as r')
        ->join('cliente as c', 'r.fk_cliente', '=', 'c.pk_cliente')
        ->join('coach as co', 'r.fk_coach', '=', 'co.pk_coach')
        ->join('usuario as u', 'c.fk_usuario', '=', 'u.pk_usuario')
        ->join('persona as p', 'u.fk_persona', '=', 'p.pk_persona')
        ->join('usuario as u2', 'co.fk_usuario', '=', 'u2.pk_usuario')
        ->join('persona as p2', 'u2.fk_persona', '=', 'p2.pk_persona')
        ->where('c.pk_cliente', $clienteId)
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

    return view('welcome', compact('rutinasC'));
}
    function validarDatos(Request $request)
    {
        return $request->validate([
            'foto' => 'required|file|image|max:2048',
            'fk_usuario' => 'required|exists:usuarios,id',
        ]);
    }

    function store(Request $request)
    {
        try {
            $ultimopk = Cliente::orderBy('pk_cliente', 'desc')->first();
            $pkC = $ultimopk ? $ultimopk->pk_cliente + 1 : 1;

            $cliente = new Cliente();
            $cliente->cod_cliente = 'COD' . $pkC;
            $cliente->estatus = 1;
            $cliente->foto = $request->foto->store('fotos', 'public');
            $cliente->fk_usuario = $request->fk_usuario;
            $cliente->save();

            return redirect()->route('cliente.create')->with('success', 'Cliente creado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al ejecutar la consulta: ' . $e->getMessage());
        }
    }

    public function create()
    {
        $datos = DB::table('usuario as u')
            ->join('persona as p', 'u.fk_persona', '=', 'p.pk_persona')
            ->leftJoin('cliente as c', 'u.pk_usuario', '=', 'c.fk_usuario')
            ->leftJoin('coach as ch', 'u.pk_usuario', '=', 'ch.fk_usuario')
            ->select('u.correo', 'p.nombre', 'u.pk_usuario')
            ->whereNull('c.pk_cliente')
            ->whereNull('ch.pk_coach')
            ->get();

        return view('registroCliente', compact('datos'));
    }

    public function show($id)
    {
        $rutinaCD = DB::table('rutina as r')
        ->join('cliente as c', 'r.fk_cliente', '=', 'c.pk_cliente')
        ->join('coach as co', 'r.fk_coach', '=', 'co.pk_coach')
        ->join('usuario as u', 'c.fk_usuario', '=', 'u.pk_usuario')
        ->join('persona as p', 'u.fk_persona', '=', 'p.pk_persona')
        ->join('usuario as u2', 'co.fk_usuario', '=', 'u2.pk_usuario')
        ->join('persona as p2', 'u2.fk_persona', '=', 'p2.pk_persona')
        ->leftJoin('medida as m', 'u.pk_usuario', '=', 'm.fk_usuario')
        ->where('r.pk_rutina', $id)
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
            'p2.nombre as nombre_coach',
            'm.peso as peso_cliente',
            'm.estatura as estatura_cliente'
        )
        ->first();
        $comentarios = Comentario::where('fk_rutina', $id)
        ->with('usuario.persona') 
        ->get();
        return view('ClienteDRView', [
            'rutina' => $rutinaCD,
            'comentarios' => $comentarios,
        ]);

    }
}
