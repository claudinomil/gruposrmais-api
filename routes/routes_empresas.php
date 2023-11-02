<?php

use App\Http\Controllers\EmpresaController;

Route::prefix('empresas')->group(function () {
    Route::get('/index/{empresa_id}', [EmpresaController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [EmpresaController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/filter/{array_dados}/{empresa_id}', [EmpresaController::class, 'filter'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store/{empresa_id}', [EmpresaController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}/{empresa_id}', [EmpresaController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}/{empresa_id}', [EmpresaController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);
});
