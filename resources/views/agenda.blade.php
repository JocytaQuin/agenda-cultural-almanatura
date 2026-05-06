<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agenda Cultural AlmaNatura</title>

    <style>

        body{
            font-family: Arial, sans-serif;
            background:#f5f2ef;
            margin:0;
            padding:40px;
            color:#2c2c2c;
        }

        .encabezado{
            background:#5e1541;
            color:white;
            padding:40px;
            border-radius:0 0 30px 30px;
            margin:-40px -40px 40px -40px;
        }

        .logo{
            font-size:30px;
            font-weight:bold;
            color:#d8cfc7;
            margin-bottom:20px;
        }

        .encabezado h1{
            color:white;
            font-size:48px;
            margin:0;
        }

        .encabezado p{
            font-size:20px;
            margin-top:10px;
        }

        main{
            max-width:1100px;
            margin:auto;
        }

        h2{
            color:#5e1541;
            margin-top:50px;
            margin-bottom:25px;
            font-size:32px;
        }

        .evento{
            background:white;
            border-radius:20px;
            padding:30px;
            margin-bottom:25px;
            box-shadow:0 4px 12px rgba(0,0,0,0.08);
            border-left:8px solid #5e1541;
        }

        .evento h3{
            color:#5e1541;
            font-size:30px;
            margin-top:0;
            margin-bottom:18px;
        }

        .dato{
            font-size:18px;
            margin:8px 0;
        }

        .descripcion{
            margin-top:20px;
            font-size:19px;
            line-height:1.6;
        }

        .boton{
            display:inline-block;
            margin-top:20px;
            background:#5e1541;
            color:white;
            padding:14px 22px;
            border-radius:12px;
            text-decoration:none;
            font-weight:bold;
            font-size:18px;
        }

        .boton:hover{
            background:#7a2358;
        }

        .pasado{
            opacity:0.92;
            border-left:8px solid #a8a198;
        }

        .vacio{
            background:white;
            padding:20px;
            border-radius:12px;
            color:#666;
            font-size:18px;
        }

    </style>
</head>

<body>

<header class="encabezado">

    <div class="logo">
        almaNatura
    </div>

    <h1>Agenda Cultural</h1>

    <p>
        Actividades culturales y comunitarias
    </p>

</header>

<main>

<section>

    <h2>Próximos eventos</h2>

    @forelse($eventosActivos as $evento)

        <div class="evento">

            <h3>{{ $evento->nombre }}</h3>

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

            <p class="descripcion">
                {{ $evento->descripcion }}
            </p>

            <a href="/evento/{{ $evento->id }}" class="boton">
    Ver más
</a>

        </div>

    @empty

        <p class="vacio">
            No hay próximos eventos registrados.
        </p>

    @endforelse

</section>

<section>

    <h2>Eventos pasados</h2>

    @forelse($eventosPasados as $evento)

        <div class="evento pasado">

            <h3>{{ $evento->nombre }}</h3>

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

            <p class="descripcion">
                {{ $evento->descripcion }}
            </p>

            <a href="/evento/{{ $evento->id }}" class="boton">
    Ver historial
</a>

        </div>

    @empty

        <p class="vacio">
            No hay eventos pasados registrados.
        </p>

    @endforelse

</section>

</main>

</body>
</html>