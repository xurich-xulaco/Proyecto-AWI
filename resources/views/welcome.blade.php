{{-- resources/views/welcome.blade.php --}}
@extends('layouts.app')

@section('content')
  <div class="text-center my-5">
    <h1 class="adw-primary-text">¡Bienvenido a Pizza Hat!</h1>
    <p class="lead">La mejor pizza con UI Adwaita y animación 3D.</p>
  </div>

  {{-- Loader 3D --}}
  <div class="d-flex justify-content-center">
    <canvas id="pizza-loader" width="300" height="300"></canvas>
  </div>

  {{-- Inicialización del loader --}}
  @push('scripts')
    <script type="module">
      // Espera a que Vite haya cargado app.js
      document.addEventListener('DOMContentLoaded', () => {
        initPizzaLoader('pizza-loader', '/models/pizza.glb');
      });
    </script>
  @endpush
@endsection
