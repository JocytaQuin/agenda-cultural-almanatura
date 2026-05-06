<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Participante;
use Illuminate\Http\Request;

class InscripcionController extends Controller
{
    public function create($id)
    {
        $evento = Evento::findOrFail($id);

        return view('inscripcion', compact('evento'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'telefono' => 'required|string|max:20',
        ]);

        Participante::create([
            'evento_id' => $id,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'fecha_inscripcion' => now(),
        ]);

        return redirect('/evento/' . $id)->with('success', 'Inscripción realizada correctamente.');
    }
}