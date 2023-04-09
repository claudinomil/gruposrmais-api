<?php

use App\Http\Controllers\EstadoCivilController;

Route::prefix('estados_civis')->group(function () {
    Route::get('/index', [EstadoCivilController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [EstadoCivilController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/search/{field}/{value}', [EstadoCivilController::class, 'search'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/research/{fieldSearch}/{fieldValue}/{fieldReturn}', [EstadoCivilController::class, 'research'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store', [EstadoCivilController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}', [EstadoCivilController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}', [EstadoCivilController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);
});
