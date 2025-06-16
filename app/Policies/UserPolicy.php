<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Определяет, может ли пользовать получить информацию от пользователе.
     */
    public function getUser(User $user, User $userShow): bool
    {
        return $user->role === 'admin' || $user->id === $userShow->id;
    }

    /**
     * Определяет, может ли пользовать редактировать пользователя.
     */
    public function update(User $user, User $userEdit): bool
    {
        return $user->role === 'admin' || $user->id === $userEdit->id;
    }

    /**
     * Определяет, может ли пользовать удалить пользователя.
     */
    public function delete(User $user, User $userDelete): bool
    {
        return $user->role === 'admin' || $user->id === $userDelete->id;
    }
}
