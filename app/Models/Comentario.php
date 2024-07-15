<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    protected $table = 'comentario'; 

    protected $primaryKey = 'pk_comentario';
    protected $fillable = ['comentario', 'estatus', 'fecha', 'fk_rutina', 'fk_usuario']; 

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'fk_usuario', 'pk_usuario');
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'fk_usuario', 'fk_persona');
    }
}
