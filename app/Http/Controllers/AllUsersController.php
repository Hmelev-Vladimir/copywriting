<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Storage;

class AllUsersController extends Controller
{
    //
    public function getUser(Request $request){
        $user = User::findOrFail($request->id);
        if ($request->user()->cannot('update', $user)) {
            abort(403);
        }
        return response()->json([
            'user' => $user
        ], 200);
    }
    public function update (ProfileUpdateRequest $request) {

        $user = $request->user();

        // Получение публичного диска.
        $disk = Storage::disk('public');

        // По умолчанию выбираем старое изображением из базы данных.
        $path =  $user->pic;

        // Пользователь загрузил изображение.
        if ($request->pic !== null) {
            if (
                // Если изображение не является заглушкой.
                $user->pic !== 'profile.jpg' &&
                // А также существует на диске.
                $disk->exists($user->pic)
            ) {
                // То удаляем его.
                $disk->delete($user->pic);
            }

            // Загрузка изображения с записью названия и расширения в переменную $path.
            $path = $disk->put('', $request->pic);
        }
        // Подмена файла изображения его названием и расширением.

        $user = $user->update(array_merge(
            $request->except(['pic', 'password']),
            [
                'pic' => $path,
                'password' => Hash::make($request->password)
            ]
        ));
        return response()->json([
            'user' => $user
        ], 200);
    }
}
