<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SubscriptionsController;
use App\Http\Controllers\StocksController;
use App\Http\Controllers\CryptoController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\PasswordResetsController;

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
    Route::get('/email/verify/{token}', [SignupController::class, 'verifyEmail'])->name('verify.email');

    Route::get('/login', [AuthController::class, 'show'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/authenticate/google', [AuthController::class, 'authGoogle'])->name('auth.google');
    Route::get('/google/login', [AuthController::class, 'googleLogin'])->name('google.login');

    Route::get('/password/change/send', [PasswordResetsController::class, 'sendEmail'])->name('reset.mail');
    Route::get('/password/change/{token}', [PasswordResetsController::class, 'show'])->name('reset.show');
    Route::post('/password/change', [PasswordResetsController::class, 'reset'])->name('password.reset');
}); 

Route::middleware('auth')->group(function() {
    Route::get('/subscriptions', [SubscriptionsController::class, 'show'])->name('subscriptions');
    Route::post('/subscriptions/{type}/update', [SubscriptionsController::class, 'update'])->name('subscriptions.update');
    Route::get('/stocks', StocksController::class)->name('stocks');
    Route::get('/crypto', CryptoController::class)->name('crypto');
    Route::match(['get', 'post'], '/search', [SearchController::class, 'show'])->name('search');
    Route::post('/avatar/update', [AvatarController::class, 'update'])->name('avatar.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
