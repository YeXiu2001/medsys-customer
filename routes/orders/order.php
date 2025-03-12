<?php

use App\Http\Controllers\orders\orderController;
use Illuminate\Support\Facades\Route;

Route::get('/customer/order/{id}', [orderController::class, 'order']);
Route::post('/customer/checkout', [orderController::class, 'checkout']);
Route::get('/customer/index', [orderController::class, 'index']);
Route::get('/customer/viewItems/{id}', [orderController::class, 'viewItems'])->name('viewItems');