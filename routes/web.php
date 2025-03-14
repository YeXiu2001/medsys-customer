<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('hero');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::resources([
        '/roles' => RoleController::class,
        '/users' => UserController::class,
    ]);

   

});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/viewpharmacy/{id}', [HomeController::class, 'viewPharmacy'])->name('viewPharmacy');
include __DIR__ . '/customerauth/auth.php';
include __DIR__ . '/orders/order.php';