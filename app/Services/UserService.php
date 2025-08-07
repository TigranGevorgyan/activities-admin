<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    public function getAll(int $perPage = 10): LengthAwarePaginator
    {
        return User::with('roles')->paginate($perPage);
    }

    public function getUserFavorites(User $user, int $perPage = 10): LengthAwarePaginator
    {
        return $user->favoriteActivities()->with([
            'participant', 'activityType'
        ])->paginate($perPage);
    }
}
