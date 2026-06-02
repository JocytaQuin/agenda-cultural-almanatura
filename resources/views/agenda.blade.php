@extends('layouts.app')

@section('title', 'Agenda Cultural')

@section('content')

<main class="agenda-page">

    <section class="agenda-title">
        <h1>Agenda Cultural</h1>
        <h2>Eventos pasados</h2>
    </section>

    <section class="past-events">
    <div class="past-slider">

        <button class="slider-arrow slider-arrow-left" type="button" id="prevSlide">‹</button>

        <img src="{{ asset('img/eventos/evento1.jpg') }}" class="past-slide active" alt="Evento pasado 1">
        <img src="{{ asset('img/eventos/evento2.jpg') }}" class="past-slide" alt="Evento pasado 2">
        <img src="{{ asset('img/eventos/evento3.jpg') }}" class="past-slide" alt="Evento pasado 3">
        <img src="{{ asset('img/eventos/evento4.jpg') }}" class="past-slide" alt="Evento pasado 4">

        <button class="slider-arrow slider-arrow-right" type="button" id="nextSlide">›</button>

    </div>
</section>

    <section class="search-section">
        <div class="search-box">
            <input type="text" placeholder="Buscar evento">
            <span class="search-icon">⌕</span>
        </div>
    </section>

    <section class="upcoming-events">
        <h2>Próximos eventos</h2>

        <div class="events-grid">
            @forelse ($eventosActivos as $evento)
                <article class="event-card">

                    <div class="image-placeholder"></div>

                    <div class="event-card-info">
                        <h3>{{ $evento->nombre }}</h3>
                        <p>
                            {{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}
                            {{ $evento->hora }}
                        </p>
                    </div>

                    <a href="{{ route('evento.show', $evento->id) }}" class="event-button">
                        ¡Me interesa!
                    </a>

                </article>
            @empty
                <p>No hay próximos eventos.</p>
            @endforelse
        </div>

    </section>

</main>

@endsection