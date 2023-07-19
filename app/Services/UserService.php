<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function store(array $data) : User
    {
        $userData = $data;
        if (isset($userData['password'])) {
            $userData['password'] = Hash::make($data['password']);
        }
        $user = User::create($userData);
        event(new Registered($user));
        return $user;
    }

    public function update(array $data, User $user): User
    {
        $userData = $data;
        if (isset($data['password'])) {
            $userData['password'] = Hash::make($data['password']);
        }
        $user->update($userData);
        return $user;
    }


}
