<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    //
    public function getList(Request $request){
        $applications = Application::orderBy('created_at','desc')->get();
        return response()->json([
            'applications' => $applications
        ], 200);
    }
}
