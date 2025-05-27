@extends('layouts.app')
@section('title','Reporte inventario')
@section('content')
<h2>Reporte de inventario</h2>
<a href="{{ route('manager.reports.inventory.export',['format'=>'xlsx']) }}" class="btn btn-outline-secondary mb-3">Exportar Excel</a>
<table class="table">
  <thead><tr><th>Ingrediente</th><th>Cantidad actual</th></tr></thead>
  <tbody>
    @foreach($inventory as $i)
    <tr>
      <td>{{ $i->ingrediente->name }}</td>
      <td>{{ $i->cantidad }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
