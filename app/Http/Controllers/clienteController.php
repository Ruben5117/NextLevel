<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Usuario;
use PhpParser\Node\Stmt\Catch_;

class ClienteController extends Controller
{
     function validarDatos(Request $request)
    {
        return $request->validate([
            'foto' => 'required|file|image|max:2048',
            'fk_usuario' => 'required|exists:usuarios,id',
        ]);
    }

     function store(Request $request)
     
    {
        
        try{

            $ultimopk = Cliente::orderBy('pk_cliente', 'desc')->first();
            $pkC = $ultimopk ? $ultimopk->pk_cliente + 1 : 1;

        $cliente = new Cliente();
        $cliente->cod_cliente = 'COD'. $pkC; 
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
        $usuarios = Usuario::all(); 
        return view('registroCliente', compact('usuarios')); 
    }
}
