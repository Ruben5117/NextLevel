<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\TipousuarioController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LoginController;

Route::get('/registroPersona', [PersonaController::class, 'index'])->name('persona.index');
Route::post('/personareg', [PersonaController::class, 'store'])->name('persona.store');
Route::put('/personas/{id}', [PersonaController::class, 'update'])->name('persona.update');
Route::delete('/personas/{id}', [PersonaController::class, 'destroy'])->name('persona.destroy');

Route::get('/tipo_usuario', [TipousuarioController::class, 'index'])->name('tipo_usuario.index');
Route::post('/tipousreg', [TipousuarioController::class, 'store'])->name('tipo_usuario.store');
Route::put('/tipo_usuario/{id}', [TipousuarioController::class, 'update'])->name('tipo_usuario.update');
Route::delete('/tipo_usuario/{id}', [TipousuarioController::class, 'destroy'])->name('tipo_usuario.destroy');

Route::get('/registroUsuario/{fk_persona}', [UsuarioController::class, 'index'])->name('usuario.index');
Route::post('/usuar', [UsuarioController::class, 'store'])->name('usuario.store');
Route::put('/usuario/{id}', [UsuarioController::class, 'update'])->name('usuario.update');
Route::delete('/usuario/{id}', [UsuarioController::class, 'destroy'])->name('usuario.destroy');

// Ruta para el inicio de sesión
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::get('/', function () {
    return view('LoginUsuario');
});

Route::get('/admin', function () {
    return view('IndexAdmin');
});

Route::get('/welcome', function () {
    return view ('welcome'); }) -> name ('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

