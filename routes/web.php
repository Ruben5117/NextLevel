<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\TipousuarioController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\clienteController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RutinaController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MedidasController;
use App\Models\Comentario;

Route::get('/coach/{id}', [CoachController::class, 'show'])->name('coach.show');
Route::post('/coach/{id}/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');


Route::post('welcome', [MedidasController::class, 'store'])->name('welcome.store');
Route::put('/welcome/update', [MedidasController::class, 'update'])->name('welcome.update');

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout.logout');

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
Route::delete('/usuarioAD/{id}', [UsuarioController::class, 'destroy'])->name('usuario.destroy');
Route::get('/usuariosAD', [UsuarioController::class, 'showu'])->name('usuario.showu');

Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::get('/', function () {
    return view('LoginUsuario');
});
Route::post('/cliente/store', [ClienteController::class, 'store'])->name('cliente.store'); // Almacena un nuevo cliente
Route::get('/cliente', [ClienteController::class, 'create'])->name('cliente.create'); // Muestra el formulario de registro de cliente
Route::get('/welcome', [ClienteController::class, 'index'])->name('welcome');
Route::get('/cliente/{id}', [ClienteController::class, 'show'])->name('cliente.show');

Route::post('/coach/store', [CoachController::class, 'store'])->name('coach.store'); // Almacena un nuevo cliente
Route::get('/coachs', [CoachController::class, 'create'])->name('coach.create'); 
Route::get('/coach', [CoachController::class, 'index'])->name('coach.index'); 
Route::get('/coach/{id}', [CoachController::class, 'show'])->name('coach.show');

Route::post('/rutina/store', [RutinaController::class, 'store'])->name('rutina.store'); 
Route::get('/rutina', [RutinaController::class, 'create'])->name('rutina.create'); 
Route::get('rutinas', [RutinaController::class, 'index'])->name('rutinas.index');
Route::get('/rutinas/{id}', [RutinaController::class, 'show'])->name('rutinas.show');
Route::delete('/rutinas/{id}', [RutinaController::class, 'destroy'])->name('rutina.destroy');
Route::put('/rutinas/{id}', [RutinaController::class, 'update'])->name('rutinas.update');
Route::get('/rutinas/{id}/edit', [RutinaController::class, 'edit'])->name('rutinas.edit');

Route::put('/comentario/{id}', [ComentarioController::class, 'update'])->name('comentario.update');
Route::get('/comentario/{id}/edit', [ComentarioController::class, 'edit'])->name('comentario.edit');

  

Route::get('/admin', function () {
    return view ('indexAdmin'); }) -> name ('admin');


    
      


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

