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
    @vite(['resources/css/app.css','resources/js/app.js'])
    @stack('styles')
</head>
<body class="min-vh-100 d-flex flex-column">
    @include('partials.nav') {{-- Navbar común --}}
    <main class="flex-fill container py-4">
        @yield('content')
    </main>
    @include('partials.footer')
</body>
</html>
