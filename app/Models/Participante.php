<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    protected $fillable = [
        'evento_id',
        'nombre',
        'apellido',
        'telefono',
        'fecha_inscripcion',
    ];
}