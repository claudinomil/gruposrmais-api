<?php

use App\Http\Controllers\FuncaoController;

Route::prefix('funcoes')->group(function () {
    Route::get('/index', [FuncaoController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [FuncaoController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/search/{field}/{value}', [FuncaoController::class, 'search'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/research/{fieldSearch}/{fieldValue}/{fieldReturn}', [FuncaoController::class, 'research'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('', [FuncaoController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}', [FuncaoController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}', [FuncaoController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);
});
