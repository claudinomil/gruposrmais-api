<?php

use App\Http\Controllers\ClienteController;

Route::prefix('clientes')->group(function () {
    Route::get('/index', [ClienteController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [ClienteController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/search/{field}/{value}', [ClienteController::class, 'search'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/research/{fieldSearch}/{fieldValue}/{fieldReturn}', [ClienteController::class, 'research'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store', [ClienteController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}', [ClienteController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}', [ClienteController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);

    Route::get('/auxiliary/tables', [ClienteController::class, 'auxiliary'])->middleware(['auth:api', 'scope:claudino']);

    Route::put('/updatefoto/{id}', [ClienteController::class, 'updateFoto'])->middleware(['auth:api', 'scope:claudino']);

    Route::get('/extradata/{id}', [ClienteController::class, 'extraData'])->middleware(['auth:api', 'scope:claudino']);
});
