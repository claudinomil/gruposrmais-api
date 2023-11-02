<?php

use App\Http\Controllers\GrupoController;

Route::prefix('grupos')->group(function () {
    Route::get('/index/{empresa_id}', [GrupoController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [GrupoController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/filter/{array_dados}/{empresa_id}', [GrupoController::class, 'filter'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store/{empresa_id}', [GrupoController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}/{empresa_id}', [GrupoController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}/{empresa_id}', [GrupoController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);

    Route::get('/auxiliary/tables/{empresa_id}', [GrupoController::class, 'auxiliary'])->middleware(['auth:api', 'scope:claudino']);
});
