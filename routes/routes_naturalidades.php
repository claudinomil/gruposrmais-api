<?php

use App\Http\Controllers\NaturalidadeController;

Route::prefix('naturalidades')->group(function () {
    Route::get('/index', [NaturalidadeController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [NaturalidadeController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/search/{field}/{value}', [NaturalidadeController::class, 'search'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/research/{fieldSearch}/{fieldValue}/{fieldReturn}', [NaturalidadeController::class, 'research'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store', [NaturalidadeController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}', [NaturalidadeController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}', [NaturalidadeController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);
});
