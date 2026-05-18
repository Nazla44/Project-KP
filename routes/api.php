<?php

use App\Http\Controllers\Api\Mobile\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('mobile/v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/login', [AuthController::class, 'login'])->name('api.mobile.auth.login');

        Route::middleware(['auth:sanctum', 'role:kader'])->group(function () {
            Route::get('/me', [AuthController::class, 'me'])->name('api.mobile.auth.me');
            Route::post('/logout', [AuthController::class, 'logout'])->name('api.mobile.auth.logout');
        });
    });
});
