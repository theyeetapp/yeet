<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
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

Route::middleware('auth:api')->get('/api/user', function (Request $request) {
    return $request->user();
});

Route::post('/api/bot/authenticate', [BotController::class, 'authenticate']);

Route::post('/api/bot/update', [BotController::class, 'update']);

Route::post('/api/users/{user}/telegram', [BotController::class, 'updateUser']);

Route::get('/api/users/{user}', function (User $user) {
    return [
        'user' => $user,
    ];
});

Route::get('/api/users/{user}/subscriptions/{type?}', [BotController::class, 'getSubscriptions']);

Route::get('/api/symbols/{type}', [BotController::class, 'getSymbols']);

Route::post('/ping', function () {
    $databaseStatus = "healthy";

    try {
        DB::connection()->getPdo();
    } catch (\Exception $exception) {
        $databaseStatus = "unhealthy";
    }

    return [
        "database" => $databaseStatus,
    ];
});
