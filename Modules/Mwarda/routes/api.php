<?php

use Illuminate\Support\Facades\Route;
use Modules\Mwarda\Http\Controllers\MwardaController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('mwardas', MwardaController::class)->names('mwarda');
});
