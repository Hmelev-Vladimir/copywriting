<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function user(Request $request)
    {
        return response()->json([
            'user' => $request->user(),
        ], 200);
    }
    public function login(Request $request)
    {
        // Ищем пользователя по логину.
        $user = User::where('login', $request->login)->first();
        // Также можно делать это по адресу электронной почты.
        // $user = User::where('email', $request->email)->first();

        // Если пользователь с переданными данными не найден, выдаем ошибку.
        if ($user === null || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'error' => 'Пользователя с переданными данными не существует.'
            ], 422);
        }

        // Дальнейший код срабатывает, только если пользователь ввел верные данные для авторизации.

        // Создаем токен.
        $token = $user->createToken($user->full_name, [$user->role]);

        // Формируем отклик.
        return response()->json([
            'token' => $token->plainTextToken,
            'user' => $user,
        ], 200);
    }
    public function logout(Request $request)
    {
        // Удаляем текущий авторизационный токен.
        $request->user()->currentAccessToken()->delete();

        // Формируем отклик.
        return response()->json([
            'msg' => 'Вы успешно вышли из аккаунта.'
        ], 200);
    }
    public function register(RegisterRequest $request)
    {
    // Хэшируем пароль.
        $request['password'] = Hash::make($request->password);

        // Создаем пользователя.
        $user = User::create($request->all());

        // Ищем созданного пользователя по id.
        $user = User::find($user->id);

        // Создаем авторизационный токен.
        $token = $user->createToken($user->name, [$user->role]);

        // Формируем отклик.
        return response()->json([
            'token' => $token->plainTextToken,
            'user' => $user,
        ], 200);
    }
}
