<?php

use App\Http\Controllers\NacionalidadeController;

Route::prefix('nacionalidades')->group(function () {
    Route::get('/index', [NacionalidadeController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [NacionalidadeController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/search/{field}/{value}', [NacionalidadeController::class, 'search'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/research/{fieldSearch}/{fieldValue}/{fieldReturn}', [NacionalidadeController::class, 'research'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store', [NacionalidadeController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}', [NacionalidadeController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}', [NacionalidadeController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);
});
