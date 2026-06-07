<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Participante;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function index()
    {
        $hoy = Carbon::today();

        $eventosActivos = Evento::where('fecha', '>=', $hoy)
            ->orderBy('fecha', 'asc')
            ->get();

        $eventosPasados = Evento::where('fecha', '<', $hoy)
            ->orderBy('fecha', 'desc')
            ->get();

        return view('agenda', compact('eventosActivos', 'eventosPasados'));
    }

    public function show($id)
    {
        $evento = Evento::findOrFail($id);

        return view('evento', compact('evento'));
    }

    public function inscripcion($id)
    {
        $evento = Evento::findOrFail($id);

        return view('inscripcion', compact('evento'));
    }

    public function guardarInscripcion(Request $request, $id)
    {
        $evento = Evento::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
        ]);

        Participante::create([
            'evento_id' => $evento->id,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'fecha_inscripcion' => Carbon::now(),
        ]);

        return view('confirmacion', compact('evento'));
    }
}