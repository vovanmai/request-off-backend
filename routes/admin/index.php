<?php

use App\Http\Controllers\Admin\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware(['auth:api', 'scope:admin'])->group( function () {
        Route::get('logout', [AuthController::class, 'logout']);
    });
});
