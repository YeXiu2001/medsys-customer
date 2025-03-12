<?php
use App\Http\Controllers\customerauth\cusauthController;
use Illuminate\Support\Facades\Route;

Route::get('/customer/login', [cusauthController::class, 'login']);
Route::post('/customer/verify_login', [cusauthController::class, 'verifylogin']);
Route::get('/customer/register', [cusauthController::class, 'register']);
Route::post('/customer/addcustomer', [cusauthController::class, 'addcustomer']);