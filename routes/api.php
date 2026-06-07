    <?php

    use App\Http\Controllers\Api\AuthController;
    use App\Http\Controllers\Api\EventController;
    use App\Http\Controllers\Api\KlinikController;
    use App\Http\Controllers\Api\ReportAController;
    use App\Http\Controllers\Api\ScoringRuleController;
    use App\Http\Controllers\Api\ScreeningResultController;
    use App\Http\Controllers\Api\ScreeningSessionController;
    use Illuminate\Support\Facades\Route;

    Route::post('/auth/login', [AuthController::class, 'login']);

    Route::prefix('kliniks')->name('api.kliniks.')->group(function () {
        Route::get('/', [KlinikController::class, 'index'])->name('index');
        Route::get('/nearest', [KlinikController::class, 'nearest'])->name('nearest');
        Route::get('/filters', [KlinikController::class, 'filters'])->name('filters');
        Route::get('/{klinik}', [KlinikController::class, 'show'])->name('show');
    });

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::get('/scoring-rules', [ScoringRuleController::class, 'index']);

        Route::apiResource('events', EventController::class)->except(['destroy']);
        Route::post('/events/{event}/report-a', [ReportAController::class, 'store']);

        Route::apiResource('screening-sessions', ScreeningSessionController::class)->only(['index','store','show']);
        Route::post('/screening-sessions/{screeningSession}/results', [ScreeningResultController::class, 'store']);
        Route::post('/screening-sessions/{screeningSession}/close', [ScreeningSessionController::class, 'close']);
    });
