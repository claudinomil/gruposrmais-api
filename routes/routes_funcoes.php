<?php

use App\Http\Controllers\FuncaoController;

Route::prefix('funcoes')->group(function () {
    Route::get('/index/{empresa_id}', [FuncaoController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [FuncaoController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/filter/{array_dados}/{empresa_id}', [FuncaoController::class, 'filter'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store/{empresa_id}', [FuncaoController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}/{empresa_id}', [FuncaoController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}/{empresa_id}', [FuncaoController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);
});
