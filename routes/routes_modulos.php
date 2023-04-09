<?php

use App\Http\Controllers\ModuloController;

Route::prefix('modulos')->group(function () {
    Route::get('/index', [ModuloController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [ModuloController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/search/{field}/{value}', [ModuloController::class, 'search'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/research/{fieldSearch}/{fieldValue}/{fieldReturn}', [ModuloController::class, 'research'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store', [ModuloController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}', [ModuloController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}', [ModuloController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);

    //Modulos na ordem de classificação para o menu
    //Route::get('modulosmenu', [ModuloController::class, 'menu'])->middleware(['auth:api', 'scope:claudino']);
});
