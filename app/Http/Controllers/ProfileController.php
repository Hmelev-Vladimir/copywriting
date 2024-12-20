<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\ProfileUpdateRequest;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //

    public function update (ProfileUpdateRequest $request) {
        $profile = User::findOrFail($request->id);
        if ($request->user()->cannot('update', $profile)) {
            abort(403);
        }

        // Получение публичного диска.
        $disk = Storage::disk('public');

        // По умолчанию выбираем старое изображением из базы данных.
        $path =  $profile->pic;

        // Пользователь загрузил изображение.
        if (is_file($request->pic)) {
            if (
                // Если изображение не является заглушкой.
                $profile->pic !== 'profile.jpg' &&
                // А также существует на диске.
                $disk->exists($profile->pic)
            ) {
                // То удаляем его.
                $disk->delete($profile->pic);
            }

            // Загрузка изображения с записью названия и расширения в переменную $path.
            $path = $disk->put('', $request->pic);
        }
        // Подмена файла изображения его названием и расширением.

        $profile = $profile->update(array_merge(
            $request->except(['pic', 'password']),
            [
                'pic' => $path,
                'password' => Hash::make($request->password)
            ]
        ));
        return response()->json([
            'profile' => $profile
        ], 200);
    }

}
