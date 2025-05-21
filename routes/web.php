<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Protected routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Orders
    Route::resource('orders', OrderController::class);
    Route::post('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.status.update');
    Route::get('/orders/{order}/invoice', [OrderController::class, 'generateInvoice'])->name('orders.invoice');
    
    // Admin routes (only for staff)
    Route::middleware(['role:gerente,cocinero,cajero'])->group(function () {
        // Inventory management (for managers and cooks)
        Route::middleware(['role:gerente,cocinero'])->group(function () {
            Route::resource('inventory', InventoryController::class);
        });
        
        // User management (managers only)
        Route::middleware(['role:gerente'])->group(function () {
            Route::resource('users', UserController::class);
            
            // Reports
            Route::resource('reports', ReportController::class);
            Route::get('/reports/export/sales', [ReportController::class, 'exportSales'])->name('reports.export.sales');
            Route::get('/reports/export/inventory', [ReportController::class, 'exportInventory'])->name('reports.export.inventory');
        });
    });
    
    // User profile
    Route::get('/profile', [UserController::class, 'profile'])->name('profile.edit');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [UserController::class, 'updatePassword'])->name('profile.password.update');
});