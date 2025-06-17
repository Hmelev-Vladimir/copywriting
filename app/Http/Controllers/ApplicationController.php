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
    /**
     * Получает список заявок.
     */
    public function getList(Request $request){
        $status = in_array($request->status, ['Новая','Опубликовано','На модерации','В архиве','Откликнулись','Куплено'])
            ? $request->status : '';
        $type = in_array($request->type, ['all','all-mine','customer','executor'])
            ? $request->type : '';
        $search = $request->search ?? '';

        $where = [];

        if ($status !== '') {
            array_push($where, ['status', $status]);
        }

        $applications = Application::orderBy('created_at','desc')
            ->filterByUserType($type, auth('sanctum')->user())
            ->where($where)
            ->search($search)
            ->get();
        return response()->json([
            'applications' => $applications
        ], 200);
    }

    /**
     * Получает одну заявку.
     */
    public function getApplication(Request $request){
        $application = Application::findOrFail($request->id);
        // $posts = $category->posts;
        return response()->json([
            'application' => $application
        ], 200);
    }

    /**
     * Создает объявление.
     */
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

    /**
     * Изменяет объявление.
     */
    public function update(ApplicationUpdateRequest $request) {
        $application = Application::findOrFail($request->id);

        // Получение публичного диска.
        $disk = Storage::disk('public');

        // По умолчанию выбираем старое изображением из базы данных.
        $path = $application->cover;

        // Пользователь загрузил изображение.
        if ($request->cover !== null) {
            if (
                // Если изображение не является заглушкой.
                $application->cover !== 'placeholder.png' &&
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

    /**
     * Удаляет заявку.
     */
    public function delete(Request $request) {
        $application = Application::findOrFail($request->id);

        $disk = Storage::disk('public');
        if  (
           $application->cover !== 'placeholder.png' && $disk->exists($application->cover)
        ) {
            $disk->delete($application->cover);
        }
        $application->delete();
        return response()->json(['msg' => 'Заявка была успешно удалена.'],200);
    }

    /**
     * Отклик на заявку.
     */
    public function respond(Request $request) {
        $application = Application::findOrFail($request->id);
        $user = auth('sanctum')->user();

        if ($application->executor_id !== null && $application->user_id === $user->id) {
            abort(400);
        }

        $application->executor_id = $user->id;
        $application->save();

        return response()->json([
            'message' => 'Отклик зарегестрирован.'
        ], 200);
    }
}
