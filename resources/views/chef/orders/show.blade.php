@extends('layouts.app')
@section('title','Pedido #'.$order->id)
@section('content')
<h2>Pedido #{{ $order->id }}</h2>
<ul class="list-group mb-3">
  @foreach($order->detalles as $d)
    <li class="list-group-item">
      {{ $d->pizza->name }} x{{ $d->cantidad }}
    </li>
  @endforeach
</ul>
<form action="{{ route('chef.orders.ready',$order) }}" method="POST" class="d-inline">
  @csrf @method('PATCH')
  <button class="btn btn-success">Marcar como Listo</button>
</form>
<form action="{{ route('chef.orders.missing',$order) }}" method="POST" class="d-inline ms-2">
  @csrf @method('PATCH')
  <button class="btn btn-warning">Reportar falta</button>
</form>
@endsection
