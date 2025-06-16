<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function getUser(Request $request){
        $users = User::orderBy('login')->get();
        return response()->json([
            'users' => $users
        ], 200);
    }
}
