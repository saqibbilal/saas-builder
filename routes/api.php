<?php

use App\Http\Controllers\Api\V1\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\Auth\MeController;
use App\Http\Controllers\Api\V1\Auth\LogoutController;

Route::prefix('v1/auth')->group(function () {

    // Public Routes
    Route::post('/login', LoginController::class);
    Route::post('/register', RegisterController::class);

    // Protected Routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', MeController::class);
        Route::post('/logout', LogoutController::class);
    });
});
