@extends('layouts.app')
@section('title','Pedido #'.$order->id)
@section('content')
<h2>Pedido #{{ $order->id }}</h2>
<ul class="list-group mb-3">
  @foreach($order->detalles as $d)
    <li class="list-group-item">{{ $d->pizza->name }} x{{ $d->cantidad }}</li>
  @endforeach
</ul>
<p><strong>Total:</strong> ${{ number_format($order->total,2) }}</p>
<p><strong>Estado:</strong> {{ $order->status }}</p>
@endsection
