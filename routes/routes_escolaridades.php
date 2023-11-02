<?php

use App\Http\Controllers\EscolaridadeController;

Route::prefix('escolaridades')->group(function () {
    Route::get('/index/{empresa_id}', [EscolaridadeController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [EscolaridadeController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/filter/{array_dados}/{empresa_id}', [EscolaridadeController::class, 'filter'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store/{empresa_id}', [EscolaridadeController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}/{empresa_id}', [EscolaridadeController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}/{empresa_id}', [EscolaridadeController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);
});
