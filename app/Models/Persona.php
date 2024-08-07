<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $table = 'persona'; 

    protected $fillable = ['nombre', 'fnac', 'apellidop', 'apellidom', 'estatus']; 

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'fk_persona', 'pk_persona');
    }
}
