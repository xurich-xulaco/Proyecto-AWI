@extends('layouts.app')
@section('title','Inventario (Chef)')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h2>Reporte de Inventario</h2>
  <a href="{{ route('chef.reports.inventory.export',['format'=>'pdf']) }}"
     class="btn btn-outline-secondary">
    Exportar PDF
  </a>
</div>

<table class="table table-striped">
  <thead>
    <tr>
      <th>Ingrediente</th>
      <th>Cantidad Actual</th>
    </tr>
  </thead>
  <tbody>
    @foreach($inventory as $item)
      <tr>
        <td>{{ $item->ingrediente->name }}</td>
        <td>{{ $item->cantidad }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
