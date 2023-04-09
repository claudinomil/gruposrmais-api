<?php

use App\Http\Controllers\GeneroController;

Route::prefix('generos')->group(function () {
    Route::get('/index', [GeneroController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [GeneroController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/search/{field}/{value}', [GeneroController::class, 'search'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/research/{fieldSearch}/{fieldValue}/{fieldReturn}', [GeneroController::class, 'research'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store', [GeneroController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}', [GeneroController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}', [GeneroController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);
});
