<?php

use App\Http\Controllers\ClienteController;

Route::prefix('clientes')->group(function () {
    Route::get('/index/{empresa_id}', [ClienteController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [ClienteController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/filter/{array_dados}/{empresa_id}', [ClienteController::class, 'filter'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store/{empresa_id}', [ClienteController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}/{empresa_id}', [ClienteController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}/{empresa_id}', [ClienteController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);

    Route::get('/auxiliary/tables/{empresa_id}', [ClienteController::class, 'auxiliary'])->middleware(['auth:api', 'scope:claudino']);

    Route::get('/extradata/{id}', [ClienteController::class, 'extraData'])->middleware(['auth:api', 'scope:claudino']);

    Route::get('/visita_tecnica/{id}', [ClienteController::class, 'visita_tecnica'])->middleware(['auth:api', 'scope:claudino']);

    //Cliente Serviços
    Route::get('/cliente_servicos_index/{id}', [ClienteController::class, 'cliente_servicos_index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/cliente_servicos_show/{id}', [ClienteController::class, 'cliente_servicos_show'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/cliente_servicos_store', [ClienteController::class, 'cliente_servicos_store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/cliente_servicos_update/{id}', [ClienteController::class, 'cliente_servicos_update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/cliente_servicos_destroy/{id}', [ClienteController::class, 'cliente_servicos_destroy'])->middleware(['auth:api', 'scope:claudino']);
});
