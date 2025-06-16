<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\User;
use App\Http\Requests\ApplicationUpdateRequest;
use App\Http\Requests\ApplicationCreateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function getList(Request $request){
        $applications = Application::orderBy('created_at','desc')->get();
        return response()->json([
            'applications' => $applications
        ], 200);
    }

    public function getApplication(Request $request){
        $application = Application::findOrFail($request->id);
        // $posts = $category->posts;
        return response()->json([
            'application' => $application
        ],200);

    }

    public function create(ApplicationCreateRequest $request) {

       // Получение публичного диска.
        $disk = Storage::disk('public');

        // Загрузка изображения с записью названия и расширения в переменную $path.
        $path = $disk->put('', $request->cover);

        $application = $request->user()-> applications()->create(array_merge(
            $request->except(['cover']),
            [
                'cover' => $path
            ]
        ));

        return response()->json([
            'application' => $application
        ], 200);
    }

    public function update(ApplicationUpdateRequest $request) {
        // $application =  Application::findOrFail($request->id);

        // $disk = Storage::disk('public');
        // $path = $disk->put('',$request->cover);

        // if ($request->cover !== null) {

        //     if  (
        //         $application->cover !== 'default-featured-image.jpg' && $disk->exists($application->cover)
        //      ) {
        //          $disk->delete($application->cover);
        //         }
        //     $path= $disk->put('', $request->cover);
        // }
        $application = Application::findOrFail($request->id);

        // Получение публичного диска.
        $disk = Storage::disk('public');

        // По умолчанию выбираем старое изображением из базы данных.
        $path = $application->cover;

        // Пользователь загрузил изображение.
        if ($request->cover !== null) {
            if (
                // Если изображение не является заглушкой.
                $application->cover !== 'default-featured-image.jpg' &&
                // А также существует на диске.
                $disk->exists($application->cover)
            ) {
                // То удаляем его.
                $disk->delete($application->cover);
            }

            // Загрузка изображения с записью названия и расширения в переменную $path.
            $path = $disk->put('', $request->cover);
        }
        // Подмена файла изображения его названием и расширением.

        $application = $application->update(array_merge(
            $request->except(['cover']),
            ['cover' => $path]
        ));
        return response()->json([
            'application' => $application
        ], 200);
    }




    public function delete(Request $request) {
        $application = Application::findOrFail($request->id);

        $disk = Storage::disk('public');
        if  (
           $application->cover !== 'default-featured-image.jpg' && $disk->exists($application->cover)
        ) {
            $disk->delete($application->cover);
        }
        $application->delete();
        return response()->json([ 'msg' => 'Объявление был успешно удалено.'],200);
    }
}
