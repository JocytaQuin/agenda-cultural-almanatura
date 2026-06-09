@extends('layouts.app')

@section('title', $evento->nombre)

@section('content')

<main class="evento-page">

    <section class="evento-detalle">

        <img src="{{ asset('img/eventos-proximos/' . $evento->imagen) }}"
                    class="event-detail-img"
                    alt="{{ $evento->nombre }}">

        <div class="evento-info">

            <h1>

                @if($evento->tipo_actividad == 'Circo')
                    🎪
                @elseif($evento->tipo_actividad == 'Taller')
                    🎨
                @elseif($evento->tipo_actividad == 'Concierto')
                    🎵
                @else
                    🎭
                @endif

                {{ $evento->nombre }}

            </h1>

            <div class="evento-datos">

                <p class="evento-dato">
                    <strong>📅 Fecha:</strong>
                    {{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}
                </p>

                <p class="evento-dato">
                    <strong>🕒 Hora:</strong>
                    {{ \Carbon\Carbon::parse($evento->hora)->format('H:i') }}
                </p>

                <p class="evento-dato">

                    <strong>📍 Lugar:</strong><br>

                    <a href="https://maps.google.com/?q=Fundación+AlmaNatura,+C.+Huelva,+21280+Arroyomolinos+de+León,+Huelva,+España"
                       target="_blank"
                       class="evento-mapa">

                        Fundación AlmaNatura<br>
                        C. Huelva, 21280 Arroyomolinos de León, Huelva, España

                    </a>

                </p>

                <p class="evento-dato">
                    <strong>👥 Cupos disponibles:</strong>
                    {{ $evento->cupos }}
                </p>

            </div>

            <h2 class="evento-subtitulo">
                📝 Descripción
            </h2>

            <p class="evento-descripcion">
                {{ $evento->descripcion }}
            </p>

            @if($evento->fecha >= date('Y-m-d'))

                @if($evento->cupos > 0)

                    <a href="{{ $evento->google_sheet_url }}"
                       target="_blank"
                       class="event-button">

                        ¡Me interesa!

                    </a>

                @else

                    <p class="evento-sin-cupos">
                        🚫 Sin cupos disponibles
                    </p>

                @endif

            @else

                <p class="evento-finalizado">
                    Este evento ya fue realizado y se mantiene disponible como historial.
                </p>

            @endif

        </div>

    </section>

</main>

@endsection