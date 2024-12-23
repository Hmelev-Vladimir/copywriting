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

    public function getUser(User $user, User $userShow): bool
    {
        return $user->role === 'admin' || $user->id === $userShow->id;
    }

    public function update(User $user, User $userEdit): bool
    {
        return $user->role === 'admin' || $user->id === $userEdit->id;
    }

    public function delete(User $user, User $userDelete): bool
    {
        return $user->role === 'admin' || $user->id === $userDelete->id;
    }
}
