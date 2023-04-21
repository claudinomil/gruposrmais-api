<?php

use App\Http\Controllers\PropostaController;

Route::prefix('propostas')->group(function () {
    Route::get('/index', [PropostaController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [PropostaController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/search/{field}/{value}', [PropostaController::class, 'search'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/research/{fieldSearch}/{fieldValue}/{fieldReturn}', [PropostaController::class, 'research'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store', [PropostaController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}', [PropostaController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}', [PropostaController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);

    Route::get('/auxiliary/tables', [PropostaController::class, 'auxiliary'])->middleware(['auth:api', 'scope:claudino']);
});
