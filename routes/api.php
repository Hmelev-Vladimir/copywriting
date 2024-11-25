<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;

Route::prefix('applications')-> group(function () {
    Route::get('getList', [ApplicationController::class,'getList']);
    Route::get('getApplication', [ApplicationController::class,'getApplication']);
    Route::post('create', [ApplicationController::class,'create']);
    Route::delete('delete', [ApplicationController::class,'delete']);
    Route::post('update', [ApplicationController::class,'update']);
});
