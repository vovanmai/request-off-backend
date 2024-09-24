<?php

use App\Http\Controllers\User\RoleController;
use Illuminate\Support\Facades\Route;

Route::prefix('roles')->group(function () {
    Route::get('', [RoleController::class, 'index']);
});
