<?php

use App\Http\Controllers\NotificacaoController;

Route::prefix('notificacoes')->group(function () {
    Route::get('/index/{empresa_id}', [NotificacaoController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [NotificacaoController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/search/{field}/{value}/{empresa_id}', [NotificacaoController::class, 'search'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/research/{fieldSearch}/{fieldValue}/{fieldReturn}/{empresa_id}', [NotificacaoController::class, 'research'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store/{empresa_id}', [NotificacaoController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}/{empresa_id}', [NotificacaoController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}/{empresa_id}', [NotificacaoController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);

    Route::get('/unreadNotificacoes/{id}', [NotificacaoController::class, 'unreadNotificacoes'])->middleware(['auth:api', 'scope:claudino']);
});
