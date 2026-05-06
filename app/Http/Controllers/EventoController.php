<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Carbon\Carbon;

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

        return view('agenda', compact(
            'eventosActivos',
            'eventosPasados'
        ));
    }

    public function show($id)
    {
        $evento = Evento::findOrFail($id);

        return view('evento', compact('evento'));
    }
}