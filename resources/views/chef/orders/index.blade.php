@extends('layouts.app')
@section('title','Pedidos para preparar')
@section('content')
<h2>Pedidos en cocina</h2>
<table class="table">
  <thead><tr><th>#</th><th>Cliente</th><th>Acciones</th></tr></thead>
  <tbody>
    @foreach($orders as $o)
    <tr>
      <td>{{ $o->id }}</td>
      <td>{{ $o->user->name }}</td>
      <td>
        <a href="{{ route('chef.orders.show',$o) }}" class="btn btn-primary btn-sm">Detalle</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
