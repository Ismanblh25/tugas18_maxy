<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Authentication routes (Login, Register, Password Reset)
Auth::routes();

// Home route (after login)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Public route to welcome page (optional)
Route::get('/', function () {
    return view('welcome');
});

// Protected routes that require authentication
Route::middleware(['auth'])->group(function () {
    // Product routes
    Route::resource('products', ProductController::class);

    // Customer routes
    Route::resource('customers', CustomerController::class);

    // Order routes
    Route::resource('orders', OrderController::class);

    // Supplier routes
    Route::resource('suppliers', SupplierController::class);
});

// (Optional) Custom Logout Route
// By default, Laravel provides a built-in logout route. You don't need this unless you want to override it.
Route::get('/logout', function() {
    Auth::logout();
    return redirect('/');
})->name('logout');
