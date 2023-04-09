<?php

use App\Http\Controllers\SubmoduloController;

Route::prefix('submodulos')->group(function () {
    Route::get('/index', [SubmoduloController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [SubmoduloController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/search/{field}/{value}', [SubmoduloController::class, 'search'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/research/{fieldSearch}/{fieldValue}/{fieldReturn}', [SubmoduloController::class, 'research'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store', [SubmoduloController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}', [SubmoduloController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}', [SubmoduloController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);

    Route::get('/auxiliary/tables', [SubmoduloController::class, 'auxiliary'])->middleware(['auth:api', 'scope:claudino']);

    //Submmodulos na ordem de classificação para o menu
    //Route::get('submodulosmenu', [SubmoduloController::class, 'menu'])->middleware(['auth:api', 'scope:claudino']);
});
