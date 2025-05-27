@extends('layouts.app')
@section('title','Reporte de ventas')
@section('content')
<h2>Reporte de ventas</h2>
<form method="GET" class="row g-2 mb-3">
  <div class="col-auto"><input type="date" name="from" class="form-control" value="{{ request('from') }}"></div>
  <div class="col-auto"><input type="date" name="to" class="form-control" value="{{ request('to') }}"></div>
  <div class="col-auto"><button class="btn btn-primary">Filtrar</button></div>
</form>
<a href="{{ route('manager.reports.sales.export',['format'=>'pdf','from'=>request('from'),'to'=>request('to')]) }}"
   class="btn btn-outline-secondary mb-3">Exportar PDF</a>
<canvas id="chart-sales" style="height:300px;"></canvas>
@push('scripts')
<script>
  const ctx = document.getElementById('chart-sales').getContext('2d');
  new Chart(ctx, {
    type: 'line',
    data: @json($chartData),
    options: {}
  });
</script>
@endpush
@endsection
