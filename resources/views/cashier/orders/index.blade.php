@extends('layouts.app')
@section('title','Pedidos pendientes (Cajero)')
@section('content')
<h2>Pedidos pendientes</h2>
<table class="table">
  <thead><tr><th>#</th><th>Cliente</th><th>Total</th><th>Acción</th></tr></thead>
  <tbody>
    @foreach($orders as $o)
    <tr>
      <td>{{ $o->id }}</td>
      <td>{{ $o->user->name }}</td>
      <td>${{ number_format($o->total,2) }}</td>
      <td>
        <form method="POST" action="{{ route('cashier.orders.close',$o) }}">
          @csrf @method('PATCH')
          <button class="btn btn-success btn-sm">Cerrar pedido</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
