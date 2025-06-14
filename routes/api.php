<?php

use App\Http\Controllers\PlaceController;
use Illuminate\Support\Facades\Route;

Route::middleware('check.api.key')->prefix('clients')->group(function () {
    Route::get('/', [PlaceController::class, '']);
    Route::post('/', [PlaceController::class, '']);
    Route::get('/{id}', [PlaceController::class, '']);
    Route::put('/{id}', [PlaceController::class, '']);
});
