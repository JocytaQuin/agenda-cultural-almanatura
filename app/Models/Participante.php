<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    protected $table = 'participantes';

    protected $fillable = [
        'evento_id',
        'nombre',
        'apellido',
        'telefono',
        'fecha_inscripcion',
    ];

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}