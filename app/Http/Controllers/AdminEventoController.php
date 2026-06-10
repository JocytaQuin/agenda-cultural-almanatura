<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class AdminEventoController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function validarLogin(Request $request)
    {
        $request->validate([
            'usuario' => 'required',
            'password' => 'required',
        ]);

        if ($request->usuario === 'admin' && $request->password === 'almanatura123') {
            session(['admin_logueado' => true]);
            return redirect()->route('admin.eventos');
        }

        return back()->with('error', 'Usuario o contraseña incorrectos');
    }

    public function index()
{
    if (!session('admin_logueado')) {
        return redirect()->route('admin.login');
    }

    $eventos = Evento::withCount('participantes')
        ->orderBy('fecha', 'asc')
        ->orderBy('hora', 'asc')
        ->get();

    return view('admin.eventos.index', compact('eventos'));
}

    public function crear()
    {
        if (!session('admin_logueado')) {
            return redirect()->route('admin.login');
        }

        return view('admin.eventos.crear');
    }

    public function guardar(Request $request)
    {
        if (!session('admin_logueado')) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'hora' => 'required',
            'cupos' => 'required|integer|min:0',
            'tipo_actividad' => 'required|string|max:100',
            'imagen' => 'required|string|max:255',
            'google_sheet_url' => 'nullable|string',
            'google_sheet_csv_url' => 'nullable|string',
        ]);

        Evento::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'lugar' => 'Fundación AlmaNatura',
            'cupos' => $request->cupos,
            'tipo_actividad' => $request->tipo_actividad,
            'imagen' => $request->imagen,
            'google_sheet_url' => $request->google_sheet_url,
            'google_sheet_csv_url' => $request->google_sheet_csv_url,
        ]);

        return redirect()
            ->route('admin.eventos')
            ->with('success', 'Evento creado correctamente.');
    }

    public function editar($id)
    {
        if (!session('admin_logueado')) {
            return redirect()->route('admin.login');
        }

        $evento = Evento::findOrFail($id);

        return view('admin.eventos.editar', compact('evento'));
    }

    public function actualizar(Request $request, $id)
    {
        if (!session('admin_logueado')) {
            return redirect()->route('admin.login');
        }

        $evento = Evento::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'hora' => 'required',
            'cupos' => 'required|integer|min:0',
            'tipo_actividad' => 'required|string|max:100',
            'imagen' => 'required|string|max:255',
            'google_sheet_url' => 'nullable|string',
            'google_sheet_csv_url' => 'nullable|string',
        ]);

        $evento->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'lugar' => 'Fundación AlmaNatura',
            'cupos' => $request->cupos,
            'tipo_actividad' => $request->tipo_actividad,
            'imagen' => $request->imagen,
            'google_sheet_url' => $request->google_sheet_url,
            'google_sheet_csv_url' => $request->google_sheet_csv_url,
        ]);

        return redirect()
            ->route('admin.eventos')
            ->with('success', 'Evento actualizado correctamente.');
    }
            public function participantes($id)
    {
    if (!session('admin_logueado')) {
        return redirect()->route('admin.login');
    }

    $evento = Evento::with('participantes')->findOrFail($id);

    return view('admin.eventos.participantes', compact('evento'));
}
    public function eliminar($id)
    {
        if (!session('admin_logueado')) {
            return redirect()->route('admin.login');
        }

        $evento = Evento::findOrFail($id);
        $evento->delete();

        return redirect()
            ->route('admin.eventos')
            ->with('success', 'Evento eliminado correctamente.');
    }
}