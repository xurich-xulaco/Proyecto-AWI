@extends('layouts.app')
@section('title','Mis pedidos')
@section('content')
<h2>Mis pedidos</h2>
<a href="{{ route('customer.orders.create') }}" class="btn btn-success mb-3">Nuevo pedido</a>
<table class="table">
  <thead>
    <tr><th>#</th><th>Estado</th><th>Total</th><th>Acción</th></tr>
  </thead>
  <tbody>
    @foreach($orders as $o)
    <tr>
      <td>{{ $o->id }}</td>
      <td>{{ $o->status }}</td>
      <td>{{ number_format($o->total,2) }}</td>
      <td><a href="{{ route('customer.orders.show',$o) }}" class="btn btn-sm btn-primary">Ver</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
