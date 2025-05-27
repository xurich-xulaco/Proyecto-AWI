<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    data-theme="{{ request()->cookie('adw-theme','light') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss','resources/js/app.js'])
    <!-- CDN de ADWaveCSS -->
    <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/gh/ncpa0/ADWaveCSS@master/dist/adwave.css">
    @stack('styles')
</head>
<body class="min-vh-100 d-flex flex-column">
    @include('partials.nav') {{-- Navbar común --}}
    <main class="flex-fill container py-4">
        @yield('content')
    </main>
    @include('partials.footer')
    <!-- tu <script> de JS generado por Vite -->
    @vite(['resources/js/app.js'])
    <!-- CDN de ADWaveUI -->
    <script src="https://cdn.jsdelivr.net/gh/ncpa0/ADWaveUI@master/dist/adwave-ui.js"></script>
</body>
</html>
