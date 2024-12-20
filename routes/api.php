<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AllUsersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PicController;

Route::prefix('applications')-> group(function () {
    Route::get('getList', [ApplicationController::class,'getList']);
    Route::get('getApplication', [ApplicationController::class,'getApplication']);
    Route::post('create', [ApplicationController::class,'create']);
    Route::delete('delete', [ApplicationController::class,'delete']);
    Route::post('update', [ApplicationController::class,'update']);
});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

// Только для авторизованных пользователей.

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('passwordReset', [AuthController::class, 'passwordReset']);

    Route::prefix('users')-> group(function () {
        Route::get('getUser', [AllUsersController::class, 'getUser']);
        Route::post('update', [ProfileController::class,'update']);
    });

    // Только для пользователей с ролью user (пользователь).
    Route::middleware('ability:user')->group(function () {
        // Роуты.
        Route::prefix('user')-> group(function () {
            Route::post('updatePic', [PicController::class,'updatePic']);
        });
    });

    Route::middleware('ability:admin')->group(function () {
        // Роуты.
        Route::prefix('admin')-> group(function () {
            Route::get('getUser', [AdminController::class,'getUser']);
        });
    });


});
