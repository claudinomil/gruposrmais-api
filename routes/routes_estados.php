<?php

use App\Http\Controllers\EstadoController;

Route::prefix('estados')->group(function () {
    Route::get('/index', [EstadoController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [EstadoController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/search/{field}/{value}', [EstadoController::class, 'search'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/research/{fieldSearch}/{fieldValue}/{fieldReturn}', [EstadoController::class, 'research'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store', [EstadoController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    //Route::put('/update/{id}', [EstadoOrganController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}', [EstadoController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);
});
