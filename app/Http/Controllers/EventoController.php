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

        // Sincroniza automáticamente al abrir el detalle del evento
        if ($evento->google_sheet_csv_url) {
            $this->sincronizarEvento($evento);
            $evento->refresh();
        }

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

        $participante = Participante::firstOrCreate(
            [
                'evento_id' => $evento->id,
                'telefono' => $request->telefono,
            ],
            [
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'fecha_inscripcion' => Carbon::now(),
            ]
        );

        if ($participante->wasRecentlyCreated && $evento->cupos > 0) {
            $evento->cupos--;
            $evento->save();
        }

        return view('confirmacion', compact('evento'));
    }

    private function sincronizarEvento($evento)
    {
        $response = Http::get($evento->google_sheet_csv_url);

        if (!$response->successful()) {
            return;
        }

        $lineas = array_map('str_getcsv', explode("\n", $response->body()));

        foreach ($lineas as $fila) {

            if (count($fila) < 5) {
                continue;
            }

            // Solo procesa filas que comienzan con fecha, por ejemplo: 8/6/2026
            if (!isset($fila[0]) || !preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}/', trim($fila[0]))) {
                continue;
            }

            $nombre = trim($fila[1] ?? '');
            $apellidoPaterno = trim($fila[2] ?? '');
            $apellidoMaterno = trim($fila[3] ?? '');
            $telefono = trim($fila[4] ?? '');

            $apellido = trim($apellidoPaterno . ' ' . $apellidoMaterno);

            if (empty($nombre) || empty($telefono)) {
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

            if ($participante->wasRecentlyCreated && $evento->cupos > 0) {
                $evento->cupos--;
                $evento->save();
            }
        }
    }

    public function sincronizarInscripciones($id)
    {
        $evento = Evento::findOrFail($id);

        if (!$evento->google_sheet_csv_url) {
            dd('El evento no tiene URL CSV configurada');
        }

        $this->sincronizarEvento($evento);

        return redirect()
            ->route('evento.show', $evento->id)
            ->with('success', 'Sincronización completada.');
    }
}