<?php

use App\Http\Controllers\DepartamentoController;

Route::prefix('departamentos')->group(function () {
    Route::get('/index/{empresa_id}', [DepartamentoController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [DepartamentoController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/filter/{array_dados}/{empresa_id}', [DepartamentoController::class, 'filter'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store/{empresa_id}', [DepartamentoController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}/{empresa_id}', [DepartamentoController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}/{empresa_id}', [DepartamentoController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);
});
