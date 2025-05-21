@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard</h1>
    
    <div class="row">
        <!-- Sales Summary Card -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title text-primary">Ventas del Día</h5>
                    <h2 class="display-4">${{ number_format($todaySales, 2) }}</h2>
                    <p class="card-text text-muted">
                        <i class="fas fa-arrow-{{ $salesTrend >= 0 ? 'up text-success' : 'down text-danger' }}"></i>
                        {{ abs($salesTrend) }}% comparado con ayer
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Orders Card -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title text-primary">Órdenes Pendientes</h5>
                    <h2 class="display-4">{{ $pendingOrders }}</h2>
                    <p class="card-text text-muted">
                        <span class="text-secondary">{{ $processingOrders }}</span> en preparación
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Inventory Alert Card -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title text-primary">Alertas de Inventario</h5>
                    <h2 class="display-4">{{ $lowStockCount }}</h2>
                    <p class="card-text text-muted">
                        Ingredientes con bajo stock
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <!-- Recent Orders -->
        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Órdenes Recientes</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cliente</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                <tr>
                                    <td>{{ $order->order_number }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>${{ number_format($order->total, 2) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $order->status_color }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('orders.index') }}" class="btn btn-outline-primary">Ver todas las órdenes</a>
                </div>
            </div>
        </div>
        
        <!-- Low Stock Items -->
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">Bajo Stock</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($lowStockItems as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $item->name }}
                            <span class="badge bg-danger rounded-pill">
                                {{ $item->quantity }} {{ $item->unit }}
                            </span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer">
                    <a href="{{ route('inventory.index') }}" class="btn btn-outline-warning">Ver inventario</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection