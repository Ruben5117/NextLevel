<?php
namespace App\Http\Controllers;
use Carbon\Carbon;

use App\Models\Rutina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RutinaController extends Controller
{
    function validarDatos(Request $request)
    {
        return $request->validate([
            'nombre' => 'required|string|max:50',
            'descripción' => 'required|string',
            'foto' => 'required|file|image|max:2048',
            'fk_cliente' => 'required|exists:cliente,pk_cliente',
            'fk_coach' => 'required|exists:coach,pk_coach',
        ]);
    }

    function store(Request $request)
    {
        $validatedData = $this->validarDatos($request);

        try {
            $rutina = new Rutina();
            $rutina->nombre = $validatedData['nombre']; 
            $rutina->descripción = $validatedData['descripción']; 
            $rutina->estatus = 1; 
            $rutina->foto = $request->file('foto')->store('fotos', 'public'); 
            $rutina->fecha = carbon::now();
            $rutina->fk_cliente = $validatedData['fk_cliente'];
            $rutina->fk_coach = $validatedData['fk_coach'];
            $rutina->save();

            return redirect()->route('rutina.create')->with('success', 'Rutina creada correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al ejecutar la consulta: ' . $e->getMessage());
        }
    }

    public function create()
    {
        $clientesDA = DB::table('cliente as c')
            ->join('usuario as u', 'c.fk_usuario', '=', 'u.pk_usuario')
            ->join('persona as p', 'u.fk_persona', '=', 'p.pk_persona')
            ->select('p.nombre', 'u.correo', 'c.pk_cliente')
            ->get();

        $coachs = DB::table('coach as c')
            ->join('usuario as u', 'c.fk_usuario', '=', 'u.pk_usuario')
            ->join('persona as p', 'u.fk_persona', '=', 'p.pk_persona')
            ->select('p.nombre', 'u.correo', 'c.pk_coach')
            ->get();
        
        return view('registroRutina', compact('clientesDA', 'coachs'));
    }
     public function index()
    {
        $rutinas = DB::select('
        SELECT r.pk_rutina, r.nombre, r.descripción, r.foto, r.estatus, r.fecha,
               c.cod_cliente, c.foto AS foto_cliente,
               co.cod_coach,
               u.correo AS correo_cliente, p.nombre AS nombre_cliente,
               u2.correo AS correo_coach, p2.nombre AS nombre_coach
        FROM rutina r
        INNER JOIN cliente c ON r.fk_cliente = c.pk_cliente
        INNER JOIN coach co ON r.fk_coach = co.pk_coach
        INNER JOIN usuario u ON c.fk_usuario = u.pk_usuario
        INNER JOIN persona p ON u.fk_persona = p.pk_persona
        INNER JOIN usuario u2 ON co.fk_usuario = u2.pk_usuario
        INNER JOIN persona p2 ON u2.fk_persona = p2.pk_persona
        WHERE r.estatus = 1
    ');

    return view('RutinasView', compact('rutinas'));
    }
    public function destroy($pk_rutina)
    {
        try {
            
            $rutina = Rutina::findOrFail($pk_rutina);
         
            $rutina->estatus = 0; 
            
            $rutina->save();
            
            return redirect()->back()->with('success', 'Rutina desactivado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al ejecutar la consulta: ' . $e->getMessage());
        }
    }
    public function show($id)
    {
        $rutinaDetalle = DB::table('rutina as r')
        ->join('cliente as c', 'r.fk_cliente', '=', 'c.pk_cliente')
        ->join('coach as co', 'r.fk_coach', '=', 'co.pk_coach')
        ->join('usuario as u', 'c.fk_usuario', '=', 'u.pk_usuario')
        ->join('persona as p', 'u.fk_persona', '=', 'p.pk_persona')
        ->join('usuario as u2', 'co.fk_usuario', '=', 'u2.pk_usuario')
        ->join('persona as p2', 'u2.fk_persona', '=', 'p2.pk_persona')
        ->where('r.estatus', 1)
        ->where('r.pk_rutina', $id)
        ->select('r.pk_rutina','r.foto as foto_rutina', 'r.nombre', 'r.descripción', 'r.foto', 'r.estatus', 'r.fecha',
                 'c.pk_cliente', 'c.cod_cliente', 'c.foto as cliente_foto', 'co.pk_coach', 'co.cod_coach',
                 'u.correo as correo_cliente', 'p.nombre as nombre_cliente',
                 'u2.correo as correo_coach', 'p2.nombre as nombre_coach')
        ->first();

        return view('DetallesView', ['rutina' => $rutinaDetalle]);
    }
    
}

