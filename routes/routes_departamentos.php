<?php

use App\Http\Controllers\DepartamentoController;

Route::prefix('departamentos')->group(function () {
    Route::get('/index', [DepartamentoController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [DepartamentoController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/search/{field}/{value}', [DepartamentoController::class, 'search'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/research/{fieldSearch}/{fieldValue}/{fieldReturn}', [DepartamentoController::class, 'research'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store', [DepartamentoController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}', [DepartamentoController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}', [DepartamentoController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);
});
