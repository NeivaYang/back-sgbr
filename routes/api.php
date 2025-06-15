<?php

use App\Http\Controllers\PlaceController;
use Illuminate\Support\Facades\Route;

Route::middleware('check.api.key')->prefix('places')->group(function () {
    Route::get('/', [PlaceController::class, 'index']);
    Route::post('/', [PlaceController::class, 'store']);
    Route::get('/search', [PlaceController::class, 'search']);
    Route::get('/{id}', [PlaceController::class, 'findById'])->whereNumber('id');
    Route::match(['put', 'patch'], '/{id}', [PlaceController::class, 'update'])->whereNumber('id');
    Route::delete('/{id}', [PlaceController::class, 'destroy'])->whereNumber('id');
});
