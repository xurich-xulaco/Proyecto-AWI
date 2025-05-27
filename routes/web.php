<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\ReportController;

require __DIR__.'/auth.php'; // Breeze

// Solo una ruta raíz:
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Rutas para Clientes
Route::middleware(['auth','role:cliente'])
     ->prefix('customer/orders')
     ->name('customer.orders.')
     ->group(function(){
    Route::get('/','Customer\OrderController@index')->name('index');
    Route::get('create','Customer\OrderController@create')->name('create');
    Route::post('/','Customer\OrderController@store')->name('store');
    Route::get('{order}','Customer\OrderController@show')->name('show');
});

// Rutas para Cajeros
Route::middleware(['auth','role:cajero'])
     ->prefix('cashier/orders')
     ->name('cashier.orders.')
     ->group(function(){
    Route::get('/','Cashier\OrderController@index')->name('index');
    Route::patch('{order}/close','Cashier\OrderController@close')->name('close');
});

// Rutas para Chefs
Route::middleware(['auth','role:chef'])
     ->prefix('chef/orders')
     ->name('chef.orders.')
     ->group(function(){
    Route::get('/','Chef\OrderController@index')->name('index');
    Route::get('{order}','Chef\OrderController@show')->name('show');
    Route::patch('{order}/ready','Chef\OrderController@ready')->name('ready');
    Route::patch('{order}/missing','Chef\OrderController@missing')->name('missing');
});
// Inventario para chefs
Route::middleware(['auth','role:chef'])
     ->prefix('chef')
     ->name('chef.')
     ->group(function(){
        Route::get('reports/{type}/export','Chef\ReportController@export')
            ->where('type','inventory')
            ->name('reports.inventory.export');

        Route::get('reports/inventory','Chef\ReportController@inventory')
            ->name('reports.inventory');
});

// Rutas para Gerentes
Route::middleware(['auth','role:gerente'])
     ->prefix('manager')
     ->name('manager.')
     ->group(function(){
    Route::resource('users','Manager\UserController')->only(['index','destroy']);
    Route::resource('orders','Manager\OrderController')->only(['index','show','destroy']);
    Route::get('reports/inventory','Manager\ReportController@inventory')->name('reports.inventory');
    Route::get('reports/sales','Manager\ReportController@sales')->name('reports.sales');
    Route::get('reports/{report}/export','Manager\ReportController@export')->name('reports.*.export');
});
