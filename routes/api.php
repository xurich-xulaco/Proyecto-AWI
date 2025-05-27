<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ReportController;

// Autenticados via Sanctum
Route::middleware('auth:sanctum')->group(function(){
    // Pedidos
    Route::apiResource('orders', OrderController::class)->only(['index','show','store','update']);
    // Reportes (solo lectura)
    Route::get('reports/inventory','ReportController@inventory');
    Route::get('reports/sales','ReportController@sales');
});
