@extends('layouts.app')
@section('title','Todos los pedidos')
@section('content')
<h2>Todos los pedidos</h2>
<table class="table">
  <thead><tr><th>#</th><th>Cliente</th><th>Total</th><th>Acciones</th></tr></thead>
  <tbody>
    @foreach($orders as $o)
    <tr>
      <td>{{ $o->id }}</td>
      <td>{{ $o->user->name }}</td>
      <td>${{ number_format($o->total,2) }}</td>
      <td>
        <a href="{{ route('manager.orders.show',$o) }}" class="btn btn-sm btn-primary">Ver</a>
        <form method="POST" action="{{ route('manager.orders.destroy',$o) }}"
              class="d-inline ms-1">
          @csrf @method('DELETE')
          <button class="btn btn-danger btn-sm">Eliminar</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
