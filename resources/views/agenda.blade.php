@extends('layouts.app')

@section('title', 'Agenda Cultural')

@section('content')

<main class="agenda-page">

    <section class="agenda-title">
        <h1>Agenda Cultural</h1>
        <h2>Historial Cultural</h2>
    </section>

    <section class="past-events">
        <div class="past-slider">

            <button class="slider-arrow slider-arrow-left" type="button" id="prevSlide"><</button>

            <img src="{{ asset('img/eventos/evento1.jpg') }}" class="past-slide active" alt="Evento pasado 1">
            <img src="{{ asset('img/eventos/evento2.jpg') }}" class="past-slide" alt="Evento pasado 2">
            <img src="{{ asset('img/eventos/evento3.jpg') }}" class="past-slide" alt="Evento pasado 3">

            <button class="slider-arrow slider-arrow-right" type="button" id="nextSlide">></button>

            <div class="slider-indicators">
                <button class="indicator active" type="button" data-slide="0"></button>
                <button class="indicator" type="button" data-slide="1"></button>
                <button class="indicator" type="button" data-slide="2"></button>
            </div>

        </div>
    </section>

    <section class="search-section">
        <div class="search-box">
            <input type="text" id="searchEvent" placeholder="Buscar por nombre del evento">
            <span class="search-icon">⌕</span>
        </div>
    </section>

    <section class="upcoming-events">
        <h2>Próximos eventos</h2>

        <div class="events-grid">
            <p id="noResults" class="no-results" style="display: none;">
    No se encontraron eventos.
</p>
            @forelse ($eventosActivos as $evento)
                <article class="event-card" data-nombre="{{ strtolower($evento->nombre) }}">

    <img src="{{ asset('img/eventos-proximos/' . $evento->imagen) }}"
         class="event-card-img"
         alt="{{ $evento->nombre }}">

    <div class="event-card-info">
        <h3>{{ $evento->nombre }}</h3>

        <p>
            {{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}
            ·
            {{ \Carbon\Carbon::parse($evento->hora)->format('H:i') }}
        </p>

        <p>AlmaNatura</p>
    </div>

    <a href="{{ route('evento.show', $evento->id) }}" class="event-button">
        Ver evento
    </a>

</article>
            @empty
                <p>No hay próximos eventos.</p>
            @endforelse
        </div>
    </section>

</main>

@endsection