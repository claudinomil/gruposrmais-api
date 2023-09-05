<?php

use App\Http\Controllers\FuncionarioController;

Route::prefix('funcionarios')->group(function () {
    Route::get('/index/{empresa_id}', [FuncionarioController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [FuncionarioController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/search/{field}/{value}/{empresa_id}', [FuncionarioController::class, 'search'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/research/{fieldSearch}/{fieldValue}/{fieldReturn}/{empresa_id}', [FuncionarioController::class, 'research'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store/{empresa_id}', [FuncionarioController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}/{empresa_id}', [FuncionarioController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}/{empresa_id}', [FuncionarioController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);

    Route::get('/auxiliary/tables/{empresa_id}', [FuncionarioController::class, 'auxiliary'])->middleware(['auth:api', 'scope:claudino']);

    Route::put('/updatefoto/{id}', [FuncionarioController::class, 'updateFoto'])->middleware(['auth:api', 'scope:claudino']);

    Route::get('/extradata/{id}', [FuncionarioController::class, 'extraData'])->middleware(['auth:api', 'scope:claudino']);

    Route::post('/store_documentos/documentos/{empresa_id}', [FuncionarioController::class, 'store_documentos'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/deletar_documento/destroy/{id}/{empresa_id}', [FuncionarioController::class, 'deletar_documento'])->middleware(['auth:api', 'scope:claudino']);
});
