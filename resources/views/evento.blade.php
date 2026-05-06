<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $evento->nombre }}</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            background:#f5f2ef;
            margin:0;
            padding:40px;
            color:#2c2c2c;
        }

        .contenedor{
            max-width:900px;
            margin:auto;
            background:white;
            padding:40px;
            border-radius:20px;
            box-shadow:0 4px 12px rgba(0,0,0,0.08);
        }

        h1{
            color:#5e1541;
            font-size:42px;
            margin-bottom:20px;
        }

        .dato{
            font-size:20px;
            margin:10px 0;
        }

        .descripcion{
            margin-top:30px;
            font-size:20px;
            line-height:1.7;
        }

        .boton{
            display:inline-block;
            margin-top:30px;
            background:#5e1541;
            color:white;
            padding:16px 24px;
            border-radius:12px;
            text-decoration:none;
            font-weight:bold;
            font-size:20px;
        }

        .boton:hover{
            background:#7a2358;
        }

        .evento-finalizado{
            margin-top:30px;
            background:#f5f2ef;
            padding:18px;
            border-radius:12px;
            font-size:18px;
            color:#5e1541;
            font-weight:bold;
        }
    </style>
</head>

<body>

<div class="contenedor">

    <h1>{{ $evento->nombre }}</h1>

    <p class="dato">
        <strong>Fecha:</strong>
        {{ $evento->fecha }}
    </p>

    <p class="dato">
        <strong>Hora:</strong>
        {{ $evento->hora }}
    </p>

    <p class="dato">
        <strong>Lugar:</strong>
        {{ $evento->lugar }}
    </p>

    <p class="dato">
        <strong>Tipo:</strong>
        {{ $evento->tipo_actividad }}
    </p>

    <div class="descripcion">
        {{ $evento->descripcion }}
    </div>

    @if($evento->fecha >= date('Y-m-d'))

        <a href="{{ $evento->google_sheet_url }}"
   target="_blank"
   class="boton">

    Me interesa

</a>

    @else

        <p class="evento-finalizado">
            Este evento ya fue realizado y se mantiene disponible como historial.
        </p>

    @endif

</div>

</body>
</html>