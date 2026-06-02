@extends('layouts.app')

@section('title', $evento->nombre)

@section('content')

<main class="evento-page">

    <section class="evento-detalle">

        <h1>Evento {{ $evento->nombre }}</h1>

        <p class="evento-dato">
            <strong>Fecha/hora:</strong>
            {{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}
            {{ $evento->hora }}
        </p>

        <p class="evento-dato">
            <strong>Lugar:</strong> {{ $evento->lugar }}
        </p>

        <p class="evento-dato">
            <strong>Tipo:</strong> {{ $evento->tipo_actividad }}
        </p>

        <p class="evento-descripcion">
            {{ $evento->descripcion }}
        </p>

        @if($evento->fecha >= date('Y-m-d'))
            <a href="{{ $evento->google_sheet_url }}" target="_blank" class="event-button">
                ¡Me interesa!
            </a>
        @else
            <p class="evento-finalizado">
                Este evento ya fue realizado y se mantiene disponible como historial.
            </p>
        @endif

    </section>

</main>

@endsection