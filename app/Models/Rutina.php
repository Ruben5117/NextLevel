<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rutina extends Model
{
    use HasFactory;

    protected $table = 'rutina';
    protected $primaryKey = 'pk_rutina';
    protected $fillable = ['nombre','descripcion','foto','estatus','fecha','fk_cliente','fk_coach'];

}
