<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AllUsersController extends Controller
{
    public function getUser(Request $request){
        $user = User::findOrFail($request->id);
        if ($request->user()->cannot('getUser', $user)) {
            abort(403);
        }
        return response()->json([
            'user' => $user
        ], 200);
    }

    public function delete(Request $request) {
        $user = User::findOrFail($request->id);

        if ($request->user()->cannot('delete', $user)) {
            abort(403);
        }
        $disk = Storage::disk('public');
        if  (
           $user->pic !== 'profile.jpg' && $disk->exists($user->pic)
        ) {
            $disk->delete($user->pic);
        }
        $user->forceDelete();
        return response()->json([ 'msg' => 'Заявка была успешно удалена.'],200);
    }
}
