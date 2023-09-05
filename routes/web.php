<?php

use App\Http\Controllers\CriarSubmodulos;
use Illuminate\Support\Facades\Route;

//Rotas para Criar Submódulos (Controller / Views / Js)
Route::get('/criarsubmodulos/{password}', [CriarSubmodulos::class, 'index'])->name('criarsubmodulos.index');
Route::post('/criarsubmodulos', [CriarSubmodulos::class, 'store'])->name('criarsubmodulos.store');

//Rota para retornar todas as Empresas do Grupo SR+
Route::get('empresas_grupo_srmais', function () {
    return \App\Models\Empresa::all();
});
