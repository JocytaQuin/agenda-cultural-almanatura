<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Eventos</title>
</head>
<body>

<h1>Administrar Eventos</h1>

@if(session('success'))
    <p style="color:green;">
        {{ session('success') }}
    </p>
@endif

<a href="{{ route('admin.eventos.crear') }}">
    Crear nuevo evento
</a>

<br><br>

<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Cupos</th>
            <th>Google Form</th>
            <th>CSV</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($eventos as $evento)
            <tr>
                <td>{{ $evento->id }}</td>
                <td>{{ $evento->nombre }}</td>
                <td>{{ $evento->fecha }}</td>
                <td>{{ $evento->hora }}</td>
                <td>{{ $evento->cupos }}</td>

                <td>
                    @if($evento->google_sheet_url)
                        Sí
                    @else
                        No
                    @endif
                </td>

                <td>
                    @if($evento->google_sheet_csv_url)
                        Sí
                    @else
                        No
                    @endif
                </td>

                <td>
                    <a href="{{ route('admin.eventos.editar', $evento->id) }}">
                        Editar
                    </a>

                    <form action="{{ route('admin.eventos.eliminar', $evento->id) }}"
                          method="POST"
                          style="display:inline;">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                onclick="return confirm('¿Seguro que deseas eliminar este evento?')">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>