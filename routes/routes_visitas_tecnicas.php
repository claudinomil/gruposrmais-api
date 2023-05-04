<?php

use App\Http\Controllers\VisitaTecnicaController;

Route::prefix('visitas_tecnicas')->group(function () {
    Route::get('/index', [VisitaTecnicaController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [VisitaTecnicaController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/search/{field}/{value}', [VisitaTecnicaController::class, 'search'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/research/{fieldSearch}/{fieldValue}/{fieldReturn}', [VisitaTecnicaController::class, 'research'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store', [VisitaTecnicaController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}', [VisitaTecnicaController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}', [VisitaTecnicaController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);

    Route::get('/auxiliary/tables', [VisitaTecnicaController::class, 'auxiliary'])->middleware(['auth:api', 'scope:claudino']);

    Route::get('/extradata/{id}', [VisitaTecnicaController::class, 'extraData'])->middleware(['auth:api', 'scope:claudino']);

    Route::get('/medidas_seguranca/{np}/{atc}/{grupo}/{divisao}', [VisitaTecnicaController::class, 'medidas_seguranca'])->middleware(['auth:api', 'scope:claudino']);
});
