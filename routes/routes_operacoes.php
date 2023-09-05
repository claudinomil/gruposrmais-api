<?php

use App\Http\Controllers\OperacaoController;

Route::prefix('operacoes')->group(function () {
    Route::get('/index/{empresa_id}', [OperacaoController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [OperacaoController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/search/{field}/{value}/{empresa_id}', [OperacaoController::class, 'search'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/research/{fieldSearch}/{fieldValue}/{fieldReturn}/{empresa_id}', [OperacaoController::class, 'research'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store/{empresa_id}', [OperacaoController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}/{empresa_id}', [OperacaoController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}/{empresa_id}', [OperacaoController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);
});
