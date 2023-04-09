<?php

use App\Http\Controllers\ServicoTipoController;

Route::prefix('servico_tipos')->group(function () {
    Route::get('/index', [ServicoTipoController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [ServicoTipoController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/search/{field}/{value}', [ServicoTipoController::class, 'search'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/research/{fieldSearch}/{fieldValue}/{fieldReturn}', [ServicoTipoController::class, 'research'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store', [ServicoTipoController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}', [ServicoTipoController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}', [ServicoTipoController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);
});
