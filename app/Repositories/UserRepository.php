<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserRepository implements UserRepositoryInterface
{

    public function findbyUsername(string $username): Model|bool|User
    {
        $result_user = User::where('username',$username)->first();
        if ($result_user) {
            return $result_user;
        }
        return false;

    }

    public function insertUser(array $user_data): void
    {
        User::create($user_data);
    }
}
