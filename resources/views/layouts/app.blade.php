<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<header class="site-header">

    <a href="{{ route('agenda.index') }}" class="site-logo">
        <img src="{{ asset('img/logos/logo.png') }}" class="logo-normal" alt="Almanatura">
        <img src="{{ asset('img/logos/logo2.png') }}" class="logo-scroll" alt="Almanatura">
    </a>

    <nav class="site-nav">
        <a href="#">Propósito</a>
        <a href="#">Espacios</a>
        <a href="#">Proyectos</a>
        <a href="#">Noticias</a>
        <a href="{{ route('agenda.index') }}" class="active">Agenda</a>
    </nav>

    <button class="menu-mobile" id="menuToggle" type="button">☰</button>
</header>

<div class="header-line"></div>

@yield('content')

</body>

<footer class="footer">

    <div class="footer-left">
        <img src="{{ asset('img/logos/logo3.png') }}" alt="AlmaNatura">
    </div>

    <div class="footer-right">

        <div class="footer-cert">
            <img src="{{ asset('img/logos/bcorp.png') }}"
                 alt="Empresa B Certificada">
        </div>

        <p>info@almanatura.com</p>

    </div>

</footer>
</html>
