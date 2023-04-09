<?php

use App\Http\Controllers\IdentidadeOrgaoController;

Route::prefix('identidade_orgaos')->group(function () {
    Route::get('/index', [IdentidadeOrgaoController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [IdentidadeOrgaoController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/search/{field}/{value}', [IdentidadeOrgaoController::class, 'search'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/research/{fieldSearch}/{fieldValue}/{fieldReturn}', [IdentidadeOrgaoController::class, 'research'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store', [IdentidadeOrgaoController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}', [IdentidadeOrgaoController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}', [IdentidadeOrgaoController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);
});
