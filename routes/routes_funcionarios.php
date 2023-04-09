<?php

use App\Http\Controllers\FuncionarioController;

Route::prefix('funcionarios')->group(function () {
    Route::get('/index', [FuncionarioController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [FuncionarioController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/search/{field}/{value}', [FuncionarioController::class, 'search'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/research/{fieldSearch}/{fieldValue}/{fieldReturn}', [FuncionarioController::class, 'research'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store', [FuncionarioController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}', [FuncionarioController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}', [FuncionarioController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);

    Route::get('/auxiliary/tables', [FuncionarioController::class, 'auxiliary'])->middleware(['auth:api', 'scope:claudino']);

    Route::put('/updatefoto/{id}', [FuncionarioController::class, 'updateFoto'])->middleware(['auth:api', 'scope:claudino']);

    Route::get('/extradata/{id}', [FuncionarioController::class, 'extraData'])->middleware(['auth:api', 'scope:claudino']);
});
