<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha',
        'hora',
        'lugar',
        'cupos',
        'imagen',
        'tipo_actividad',
        'google_sheet_url',
        'google_sheet_excel_url',
        'google_sheet_csv_url',
    ];

    public function participantes()
    {
        return $this->hasMany(Participante::class);
    }
}