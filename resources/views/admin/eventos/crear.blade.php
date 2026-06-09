<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Evento</title>
</head>
<body>

<h1>Crear Evento</h1>

<form action="{{ route('admin.eventos.guardar') }}" method="POST">
    @csrf

    <p>
        Nombre:<br>
        <input type="text" name="nombre" required>
    </p>

    <p>
        Descripción:<br>
        <textarea name="descripcion" required></textarea>
    </p>

    <p>
        Fecha:<br>
        <input type="date" name="fecha" required>
    </p>

    <p>
        Hora:<br>
        <input type="time" name="hora" required>
    </p>

    <p>
        Cupos:<br>
        <input type="number" name="cupos" required>
    </p>

    <p>
        Tipo actividad:<br>
        <input type="text" name="tipo_actividad" placeholder="Taller, Circo, Concierto" required>
    </p>

    <p>
        Imagen:<br>
        <input type="text" name="imagen" placeholder="nombre-imagen.jpg" required>
    </p>

    <p>
        URL Google Form:<br>
        <input type="text" name="google_sheet_url">
    </p>

    <p>
        URL CSV Google Sheets:<br>
        <input type="text" name="google_sheet_csv_url">
    </p>

    <button type="submit">
        Guardar Evento
    </button>
</form>

<br>

<a href="{{ route('admin.eventos') }}">
    Volver
</a>

</body>
</html>