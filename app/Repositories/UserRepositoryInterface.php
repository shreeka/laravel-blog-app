<?php

namespace App\Repositories;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface
{
    public function findByUsername(string $username): Model|bool|User;
    public function insertUser(array $user_data): void;
}
