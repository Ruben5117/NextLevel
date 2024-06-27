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
}
