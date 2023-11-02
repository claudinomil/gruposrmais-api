<?php

use App\Http\Controllers\NaturalidadeController;

Route::prefix('naturalidades')->group(function () {
    Route::get('/index/{empresa_id}', [NaturalidadeController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [NaturalidadeController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/filter/{array_dados}/{empresa_id}', [NaturalidadeController::class, 'filter'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store/{empresa_id}', [NaturalidadeController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}/{empresa_id}', [NaturalidadeController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}/{empresa_id}', [NaturalidadeController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);
});
