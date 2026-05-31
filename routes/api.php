<?php

use App\Http\Controllers\Api\V1\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\Auth\MeController;

Route::middleware('auth:sanctum')
    ->get('/v1/auth/me', MeController::class);

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/login', LoginController::class);
        Route::post('/register', RegisterController::class);
    });
});
