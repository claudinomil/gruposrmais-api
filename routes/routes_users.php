<?php

use App\Http\Controllers\UserController;

Route::prefix('users')->group(function () {
    Route::get('/index/{empresa_id}', [UserController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [UserController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/filter/{array_dados}/{empresa_id}', [UserController::class, 'filter'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store/{empresa_id}', [UserController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}/{empresa_id}', [UserController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}/{empresa_id}', [UserController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);

    Route::get('/auxiliary/tables/{empresa_id}', [UserController::class, 'auxiliary'])->middleware(['auth:api', 'scope:claudino']);

    Route::get('/profiledata/{id}', [UserController::class, 'profileData'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/updateavatar/{id}', [UserController::class, 'updateAvatar'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/editpassword/{id}', [UserController::class, 'editPassword'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/editemail/{id}', [UserController::class, 'editEmail'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/editmodestyle/{id}/{empresa_id}', [UserController::class, 'editmodestyle'])->middleware(['auth:api', 'scope:claudino']);

    //Usuário - retorna dados do usuário logado
    Route::get('/user/logged/data/{empresa_id}', [UserController::class, 'userLoggedData'])->middleware(['auth:api', 'scope:claudino']);

    //Usuário - retorna dados e permissões
    Route::get('/user/permissoes/settings/{searchSubmodulo}/{empresa_id}', [UserController::class, 'userPermissoesSettings'])->middleware(['auth:api', 'scope:claudino']);

    //Logout
    Route::post('logout', [UserController::class, 'logout'])->middleware(['auth:api', 'scope:claudino']);
});

//Verifica se usuário existe (pelo email)
Route::get('users/exist/{email}', [UserController::class, 'exist']);

//Verifica se usuário foi confirmado (pelo email)
Route::get('users/confirm/{email}', [UserController::class, 'confirm']);

//Alterar campo de confirmação de email (user_confirmed_at)
Route::post('users/confirmupdate', [UserController::class, 'update_confirm']);
