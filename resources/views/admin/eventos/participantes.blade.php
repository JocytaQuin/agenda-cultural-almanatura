<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Participantes</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            background:#a8a198;
            padding:40px;
        }

        .container{
            background:white;
            padding:30px;
            border-radius:15px;
            max-width:1000px;
            margin:auto;
        }

        h1{
            color:#6b0f45;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
        }

        th{
            background:#6b0f45;
            color:white;
            padding:12px;
        }

        td{
            padding:12px;
            border-bottom:1px solid #ddd;
        }

        .volver{
            display:inline-block;
            margin-top:20px;
            color:#6b0f45;
            text-decoration:none;
            font-weight:bold;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>Participantes inscritos</h1>

    <p>
        Evento:
        <strong>{{ $evento->nombre }}</strong>
    </p>

    <table>

        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Teléfono</th>
                <th>Fecha inscripción</th>
            </tr>
        </thead>

        <tbody>

        @forelse($evento->participantes as $participante)

            <tr>
                <td>{{ $participante->nombre }}</td>
                <td>{{ $participante->apellido }}</td>
                <td>{{ $participante->telefono }}</td>
                <td>{{ $participante->fecha_inscripcion }}</td>
            </tr>

        @empty

            <tr>
                <td colspan="4">
                    No hay participantes registrados.
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

    <a href="{{ route('admin.eventos') }}" class="volver">
        Volver al panel
    </a>

</div>

</body>
</html>