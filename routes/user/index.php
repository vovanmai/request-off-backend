<?php

use App\Http\Controllers\User\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::get('login/verify-email', [AuthController::class, 'verifyEmail']);

Route::middleware(['auth:admin', 'scope:user'])->group( function () {
    Route::get('logout', [AuthController::class, 'logout']);
});
