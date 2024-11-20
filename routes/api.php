<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;

Route::prefix('applications')-> group(function () {
    Route::get('getList', [ApplicationController::class,'getList']);
});
