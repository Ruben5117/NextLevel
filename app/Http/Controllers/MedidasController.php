<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medida;
use Carbon\Carbon;

class MedidasController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'peso' => 'required|numeric',
            'estatura' => 'required|numeric',
        ]);

        $userId = session('id');

        Medida::create([
            'peso' => $validatedData['peso'],
            'estatura' => $validatedData['estatura'],
            'fk_usuario' => $userId,
            'fecha' => Carbon::now(),
        ]);

        return redirect()->route('welcome')->with('success', 'Datos guardados correctamente');
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'peso' => 'required|numeric',
            'estatura' => 'required|numeric',
        ]);

        $userId = session('id');

        $existingMedida = Medida::where('fk_usuario', $userId)->first();

        if ($existingMedida) {
            $existingMedida->update([
                'peso' => $validatedData['peso'],
                'estatura' => $validatedData['estatura'],
                'fecha' => Carbon::now(),
            ]);

            return redirect()->route('welcome')->with('success', 'Medidas actualizadas correctamente');
        }

        return redirect()->route('welcome')->with('error', 'No se encontraron medidas para actualizar');
    }

    public function index()
    {
        $userId = session('id');
        $medida = Medida::where('fk_usuario', $userId)->first();

        return view('welcome', compact('medida'));
    }
}
