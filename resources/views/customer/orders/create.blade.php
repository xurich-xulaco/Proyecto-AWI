@extends('layouts.app')
@section('title','Nuevo pedido')
@section('content')
<h2>Arma tu pizza</h2>
<form action="{{ route('customer.orders.store') }}" method="POST">
  @csrf
  <div class="row">
    @foreach($pizzas as $pizza)
    <div class="col-md-4">
      <div class="card mb-3">
        <img src="{{ asset($pizza->image) }}" class="card-img-top" alt="{{ $pizza->name }}">
        <div class="card-body">
          <h5 class="card-title">{{ $pizza->name }}</h5>
          <p>{{ $pizza->description }}</p>
          <p><strong>${{ $pizza->price }}</strong></p>
          <div class="form-check">
            <input class="form-check-input" type="checkbox"
                   name="pizzas[]" value="{{ $pizza->id }}" id="pizza{{ $pizza->id }}">
            <label class="form-check-label" for="pizza{{ $pizza->id }}">
              Añadir
            </label>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <button class="btn btn-primary">Realizar pedido</button>
</form>
@endsection
