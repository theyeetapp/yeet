<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubscriptionsController;

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

Route::middleware('guest')->group(function() {
    
    Route::view('/', 'index')->name('index');

    Route::get('/signup', [SignupController::class, 'show'])->name('signup');
    Route::post('/signup', [SignupController::class, 'signup']);

    Route::get('/login', [AuthController::class, 'show'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
}); 

Route::middleware('auth')->group(function() {
    Route::get('/subscriptions', [SubscriptionsController::class, 'show'])->name('subscriptions');
    Route::get('/stocks', [DashboardController::class, 'stocks'])->name('stocks');
    Route::get('/crypto', [DashboardController::class, 'crypto'])->name('crypto');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
