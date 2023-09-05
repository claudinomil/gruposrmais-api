<?php

use App\Http\Controllers\ServicoController;

Route::prefix('servicos')->group(function () {
    Route::get('/index/{empresa_id}', [ServicoController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [ServicoController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/search/{field}/{value}/{empresa_id}', [ServicoController::class, 'search'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/research/{fieldSearch}/{fieldValue}/{fieldReturn}/{empresa_id}', [ServicoController::class, 'research'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store/{empresa_id}', [ServicoController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}/{empresa_id}', [ServicoController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}/{empresa_id}', [ServicoController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);

    Route::get('/auxiliary/tables/{empresa_id}', [ServicoController::class, 'auxiliary'])->middleware(['auth:api', 'scope:claudino']);
});
