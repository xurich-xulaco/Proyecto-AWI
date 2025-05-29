@extends('layouts.app')

@section('content')
<div class="adw-container adw-grid adw-col-1 adw-col-md-1 adw-max-w-sm" style="margin:auto;">
  <h2 class="adw-title">Iniciar sesión</h2>
  <form method="POST" action="{{ route('login') }}" class="adw-grid" style="gap:1rem;">
    @csrf

    <adw-input
      name="email"
      type="email"
      label="Correo electrónico"
      value="{{ old('email') }}"
      required
      autofocus
    ></adw-input>

    <adw-input
      name="password"
      type="password"
      label="Contraseña"
      required
    ></adw-input>

    <div class="adw-flex adw-justify-between">
      <label>
        <adw-checkbox name="remember" {{ old('remember') ? 'checked' : '' }}></adw-checkbox>
        Recuérdame
      </label>

      @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}" class="adw-link">¿Olvidaste tu contraseña?</a>
      @endif
    </div>

    <adw-button variant="primary" type="submit">Entrar</adw-button>
  </form>
</div>
@endsection
