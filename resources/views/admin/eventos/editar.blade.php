<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Evento</title>
</head>
<body>

<h1>Editar Evento</h1>

<form action="{{ route('admin.eventos.actualizar', $evento->id) }}" method="POST">
    @csrf
    @method('PUT')

    <p>
        Nombre:<br>
        <input type="text" name="nombre" value="{{ $evento->nombre }}" required>
    </p>

    <p>
        Descripción:<br>
        <textarea name="descripcion" required>{{ $evento->descripcion }}</textarea>
    </p>

    <p>
        Fecha:<br>
        <input type="date" name="fecha" value="{{ $evento->fecha }}" required>
    </p>

    <p>
        Hora:<br>
        <input type="time" name="hora" value="{{ $evento->hora }}" required>
    </p>

    <p>
        Cupos:<br>
        <input type="number" name="cupos" value="{{ $evento->cupos }}" required>
    </p>

    <p>
        Tipo actividad:<br>
        <input type="text" name="tipo_actividad" value="{{ $evento->tipo_actividad }}" required>
    </p>

    <p>
        Imagen:<br>
        <input type="text" name="imagen" value="{{ $evento->imagen }}" required>
    </p>

    <p>
        URL Google Form:<br>
        <input type="text" name="google_sheet_url" value="{{ $evento->google_sheet_url }}">
    </p>

    <p>
        URL CSV Google Sheets:<br>
        <input type="text" name="google_sheet_csv_url" value="{{ $evento->google_sheet_csv_url }}">
    </p>

    <button type="submit">Actualizar Evento</button>
</form>

<br>

<a href="{{ route('admin.eventos') }}">Volver</a>

</body>
</html>