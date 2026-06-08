<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Participante;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

    public function sincronizarInscripciones($id)
{
    $evento = Evento::findOrFail($id);

    if (!$evento->google_sheet_csv_url) {
        dd('El evento no tiene URL CSV configurada');
    }

    $response = Http::get($evento->google_sheet_csv_url);

    if (!$response->successful()) {
        dd('No se pudo leer el CSV');
    }

    $lineas = array_map('str_getcsv', explode("\n", $response->body()));

    // Quita la primera fila, que son los nombres de las columnas
    array_shift($lineas);

    $nuevos = 0;

    foreach ($lineas as $fila) {
        if (count($fila) < 5) {
            continue;
        }

        $nombre = trim($fila[1] ?? '');
        $apellidoPaterno = trim($fila[2] ?? '');
        $apellidoMaterno = trim($fila[3] ?? '');
        $telefono = trim($fila[4] ?? '');

        $apellido = trim($apellidoPaterno . ' ' . $apellidoMaterno);

        if (!$nombre || !$telefono) {
            continue;
        }

        $participante = Participante::firstOrCreate(
            [
                'evento_id' => $evento->id,
                'telefono' => $telefono,
            ],
            [
                'nombre' => $nombre,
                'apellido' => $apellido,
                'fecha_inscripcion' => Carbon::now(),
            ]
        );

        if ($participante->wasRecentlyCreated) {
            $nuevos++;

            if ($evento->cupos > 0) {
                $evento->cupos = $evento->cupos - 1;
                $evento->save();
            }
        }
    }

    return redirect()->route('evento.show', $evento->id)
        ->with('success', 'Sincronización completa. Nuevos inscritos: ' . $nuevos);
}
    }
