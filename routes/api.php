<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BotController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/bot/authenticate', [BotController::class, 'authenticate']);

Route::post('/bot/update', [BotController::class, 'update']);

Route::post('/users/{user}/telegram', [BotController::class, 'updateUser']);

Route::get('/users/{user}', function (User $user) {
    return [
        'user' => $user
    ];
});

Route::get('/users/{user}/subscriptions/{type?}', [BotController::class, 'getSubscriptions']);

Route::get('/symbols/{type}', [BotController::class, 'getSymbols']);
