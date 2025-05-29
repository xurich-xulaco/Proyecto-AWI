@extends('layouts.app')

@section('content')
<h2 class="adw-title">Nuevo Pedido</h2>

<form action="{{ route('customer.orders.store') }}" method="POST" class="adw-grid" style="gap:1rem;">
  @csrf

  <adw-select name="size" label="Tamaño">
    <adw-option value="small">Pequeña</adw-option>
    <adw-option value="medium">Mediana</adw-option>
    <adw-option value="large">Grande</adw-option>
  </adw-select>

  <fieldset class="adw-fieldset">
    <legend>Ingredientes</legend>
    @foreach($ingredients as $ingredient)
      <label class="adw-checkbox-wrapper">
        <adw-checkbox name="ingredients[]" value="{{ $ingredient->id }}"></adw-checkbox>
        {{ $ingredient->name }}
      </label>
    @endforeach
  </fieldset>

  <adw-button variant="primary" type="submit">Enviar Pedido</adw-button>
</form>
@endsection
