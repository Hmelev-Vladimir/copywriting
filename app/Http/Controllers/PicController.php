<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\ProfilePicRequest;


use Illuminate\Support\Facades\Storage;



class PicController extends Controller
{
    //

    public function updatePic (ProfilePicRequest $request) {
        $profile = $request->user();

        // Получение публичного диска.
        $disk = Storage::disk('public');

        // По умолчанию выбираем старое изображением из базы данных.
        $path =  $profile->pic;
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
        //
            $profile = $profile->update(array_merge(
                $request->except(['pic']),
                [
                    'pic' => $path,
                ]
            ));
            return response()->json([
                'pic' => $path
            ], 200);
    }


}
