<?php

use App\Http\Controllers\ServicoController;

Route::prefix('servicos')->group(function () {
    Route::get('/index', [ServicoController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [ServicoController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/search/{field}/{value}', [ServicoController::class, 'search'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/research/{fieldSearch}/{fieldValue}/{fieldReturn}', [ServicoController::class, 'research'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store', [ServicoController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}', [ServicoController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}', [ServicoController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);

    Route::get('/auxiliary/tables', [ServicoController::class, 'auxiliary'])->middleware(['auth:api', 'scope:claudino']);
});
