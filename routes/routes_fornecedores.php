<?php

use App\Http\Controllers\FornecedorController;

Route::prefix('fornecedores')->group(function () {
    Route::get('/index', [FornecedorController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [FornecedorController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/search/{field}/{value}', [FornecedorController::class, 'search'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/research/{fieldSearch}/{fieldValue}/{fieldReturn}', [FornecedorController::class, 'research'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store', [FornecedorController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}', [FornecedorController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}', [FornecedorController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);

    Route::get('/auxiliary/tables', [FornecedorController::class, 'auxiliary'])->middleware(['auth:api', 'scope:claudino']);

    Route::put('/updatefoto/{id}', [FornecedorController::class, 'updateFoto'])->middleware(['auth:api', 'scope:claudino']);

    Route::get('/extradata/{id}', [FornecedorController::class, 'extraData'])->middleware(['auth:api', 'scope:claudino']);
});
