<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Public routes
Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return redirect('/login');
});

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Protected routes (require authentication)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Products routes (to be created)
    Route::get('menu', [\App\Http\Controllers\ProductController::class, 'menu'])->name('menu.index');
    Route::resource('products', \App\Http\Controllers\ProductController::class);
    
    // Orders routes (to be created)
    Route::get('orders/pos', [\App\Http\Controllers\OrderController::class, 'pos'])->name('orders.pos');
    Route::post('orders/pos', [\App\Http\Controllers\OrderController::class, 'storePos'])->name('orders.storePos');
    Route::get('orders/{order}/invoice', [\App\Http\Controllers\OrderController::class, 'invoice'])->name('orders.invoice');
    Route::get('orders/kds', [\App\Http\Controllers\OrderController::class, 'kds'])->name('orders.kds');
    Route::patch('orders/{order}/status', [\App\Http\Controllers\OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::resource('orders', \App\Http\Controllers\OrderController::class);
    
    // Customers routes (to be created)
    Route::resource('customers', \App\Http\Controllers\CustomerController::class);
    
    // Categories routes (to be created)
    Route::resource('categories', \App\Http\Controllers\CategoryController::class);
    Route::post('categories/{category}/toggle-status', [\App\Http\Controllers\CategoryController::class, 'toggleStatus'])->name('categories.toggleStatus');
    
    // User management routes (admin only)
    Route::resource('users', \App\Http\Controllers\UserController::class);

    // Settings routes
    Route::get('settings', [\App\Http\Controllers\SettingsController::class, 'index'])->name('settings.index');
    Route::post('settings', [\App\Http\Controllers\SettingsController::class, 'update'])->name('settings.update');
});
