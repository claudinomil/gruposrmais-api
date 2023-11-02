<?php

use App\Http\Controllers\PropostaController;

Route::prefix('propostas')->group(function () {
    Route::get('/index/{empresa_id}', [PropostaController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [PropostaController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/filter/{array_dados}/{empresa_id}', [PropostaController::class, 'filter'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store/{empresa_id}', [PropostaController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}/{empresa_id}', [PropostaController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}/{empresa_id}', [PropostaController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);

    Route::get('/auxiliary/tables/{empresa_id}', [PropostaController::class, 'auxiliary'])->middleware(['auth:api', 'scope:claudino']);
});
