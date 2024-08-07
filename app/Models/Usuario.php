<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable 
{
    use HasFactory, Notifiable; 

  
    protected $table = 'usuario'; 
    protected $primaryKey = 'pk_usuario';
    protected $fillable = ['correo', 'contraseña', 'estatus', 'fk_persona', 'fk_tipo_usuario']; 

    
    protected $hidden = [
        'contraseña', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAuthPassword()
    {
        return $this->contraseña;
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'fk_persona', 'pk_persona');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'fk_usuario', 'pk_usuario');
    }
}
