<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medida extends Model
{
    use HasFactory;
    protected $table = 'medida';

    protected $primaryKey = 'pk_medidas';
    protected $fillable = ['peso','estatura','fecha','fk_usuario'];


}
