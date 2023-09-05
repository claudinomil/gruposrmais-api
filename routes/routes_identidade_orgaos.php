<?php

use App\Http\Controllers\IdentidadeOrgaoController;

Route::prefix('identidade_orgaos')->group(function () {
    Route::get('/index/{empresa_id}', [IdentidadeOrgaoController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [IdentidadeOrgaoController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/search/{field}/{value}/{empresa_id}', [IdentidadeOrgaoController::class, 'search'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/research/{fieldSearch}/{fieldValue}/{fieldReturn}/{empresa_id}', [IdentidadeOrgaoController::class, 'research'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store/{empresa_id}', [IdentidadeOrgaoController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}/{empresa_id}', [IdentidadeOrgaoController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}/{empresa_id}', [IdentidadeOrgaoController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);
});
