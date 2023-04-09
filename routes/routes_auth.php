<?php
//password_resets
use App\Http\Controllers\PasswordResetsController;

Route::post('password_resets/{token}', [PasswordResetsController::class, 'store']);
Route::post('password_resets_confirm', [PasswordResetsController::class, 'confirm']);
Route::post('password_resets_update_delete', [PasswordResetsController::class, 'update_delete']);
