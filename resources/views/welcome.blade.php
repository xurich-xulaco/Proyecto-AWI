@extends('layouts.app')

@section('content')
<div class="adw-container adw-grid adw-col-1 adw-col-md-2" style="gap: 2rem;">
  <div>
    {{-- Greeting 3D --}}
    <x-pizza-logo size="120" />

    <h1 class="adw-title">¡Bienvenido a PizzaHat!</h1>
    <p class="adw-text">Gestiona tus pedidos con el estilo de Adwaita.</p>
    <a href="{{ route('login') }}">
      <adw-button variant="primary">Empieza Ahora</adw-button>
    </a>
  </div>
  <div>
    @include('components.pizza-loader')
  </div>
</div>
@endsection
