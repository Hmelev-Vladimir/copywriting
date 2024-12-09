<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\ProfileUpdateRequest;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //

    public function update (ProfileUpdateRequest $request) {

        $profile = $request->user();

        // Получение публичного диска.
        $disk = Storage::disk('public');

        // По умолчанию выбираем старое изображением из базы данных.
        $path =  $profile->pic;

        // Пользователь загрузил изображение.
        if ($request->pic !== null) {
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
            $request->except(['pic']),
            ['pic' => $path]
        ));
        return response()->json([
            'profile' => $profile
        ], 200);
    }

}
