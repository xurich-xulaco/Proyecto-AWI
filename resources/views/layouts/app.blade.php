<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preload" href="{{ asset('fonts/AdwaitaSans-Regular.ttf') }}" as="font" type="font/ttf" crossorigin>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    @stack('styles')
</head>
<body class="min-vh-100 d-flex flex-column">
    @include('partials.nav')

    <main class="adw-container" style="padding-top: 2rem;">
        @yield('content')
    </main>

    @include('partials.footer')
    <!-- tu <script> de JS generado por Vite -->
    @vite(['resources/js/app.js'])
    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
</body>
</html>
