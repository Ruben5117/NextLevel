<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\TipousuarioController;

Route::get('/registroPersona', [PersonaController::class, 'index'])->name('persona.index');
Route::post('/', [PersonaController::class, 'store'])->name('persona.store');
Route::put('/personas/{id}', [PersonaController::class, 'update'])->name('persona.update');
Route::delete('/personas/{id}', [PersonaController::class, 'destroy'])->name('persona.destroy');


Route::get('/tipo_usuario', [TipousuarioController::class, 'index'])->name('tipo_usuario.index');
Route::post('/', [TipousuarioController::class, 'store'])->name('tipo_usuario.store');
Route::put('/tipo_usuario/{id}', [TipousuarioController::class, 'update'])->name('tipo_usuario.update');
Route::delete('/tipo_usuario/{id}', [TipousuarioController::class, 'destroy'])->name('tipo_usuario.destroy');

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

