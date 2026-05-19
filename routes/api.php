<?php

use App\Http\Controllers\Api\KlinikController;
use Illuminate\Support\Facades\Route;

Route::prefix('kliniks')->name('api.kliniks.')->group(function () {
    Route::get('/', [KlinikController::class, 'index'])->name('index');
    Route::get('/nearest', [KlinikController::class, 'nearest'])->name('nearest');
    Route::get('/filters', [KlinikController::class, 'filters'])->name('filters');
    Route::get('/{klinik}', [KlinikController::class, 'show'])->name('show');
});
