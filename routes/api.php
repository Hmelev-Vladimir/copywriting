<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AllUsersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PicController;

/**
 * Общедоступные роуты.
 */

// Аутентификация.
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::prefix('applications')->group(function () {
    Route::get('getList', [ApplicationController::class,'getList']);
    Route::get('getApplication', [ApplicationController::class,'getApplication']);
});

/**
 * Только для авторизованных пользователей.
 */
Route::middleware('auth:sanctum')->group(function () {
    // Аутентификация.
    Route::get('user', [AuthController::class, 'user']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('passwordReset', [AuthController::class, 'passwordReset']);

    Route::prefix('users')-> group(function () {
        Route::get('getUser', [AllUsersController::class, 'getUser']);
        Route::post('update', [ProfileController::class, 'update']);
        Route::delete('delete', [AllUsersController::class, 'delete']);
    });

    Route::prefix('applications')-> group(function () {
        Route::post('create', [ApplicationController::class, 'create']);
        Route::delete('delete', [ApplicationController::class, 'delete']);
        Route::post('update', [ApplicationController::class, 'update']);
    });

    // Только для пользователей с ролью user.
    Route::middleware('ability:user')
        ->prefix('user')
        ->group(function () {
            Route::post('updatePic', [PicController::class, 'updatePic']);
        });

    // Только для пользователей с ролью admin.
    Route::middleware('ability:admin')
        ->prefix('admin')
        ->group(function () {
            Route::get('getUser', [AdminController::class, 'getUser']);
        });
});
