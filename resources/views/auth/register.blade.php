{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.app')
@section('title','Registro')
@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <h2>Crear cuenta</h2>
    <form method="POST" action="{{ route('register') }}">
      @csrf

      <!-- Nombre -->
      <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input id="name" name="name" type="text"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name') }}" required autofocus>
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <!-- Email -->
      <div class="mb-3">
        <label for="email" class="form-label">Correo</label>
        <input id="email" name="email" type="email"
               class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email') }}" required>
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <!-- Contraseña -->
      <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input id="password" name="password" type="password"
               class="form-control @error('password') is-invalid @enderror"
               required>
        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <!-- Confirmar contraseña -->
      <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
        <input id="password_confirmation" name="password_confirmation"
               type="password" class="form-control" required>
      </div>

      <!-- Rol -->
      <div class="mb-3">
        <label for="role" class="form-label">Registrarse como</label>
        <select id="role" name="role" class="form-select @error('role') is-invalid @enderror" required>
          <option value="">-- Selecciona un rol --</option>
          @foreach(\App\Enums\Role::cases() as $r)
            <option value="{{ $r->value }}" @if(old('role')==$r->value) selected @endif>
              {{ ucfirst($r->name) }}
            </option>
          @endforeach
        </select>
        @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <button type="submit" class="btn btn-primary">Registrarse</button>
    </form>
  </div>
</div>
@endsection
