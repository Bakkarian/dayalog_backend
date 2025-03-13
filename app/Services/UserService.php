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


    public function firstOrCreate(array $data): User
    {

        $user = User::withoutGlobalScope('onlyForOrganization')->when(isset($data['email']), function ($query) use ($data) {
            $query->where('email', $data['email']);
        })->when(isset($data['phone_number']), function ($query) use ($data) {
            $query->orWhere('phone_number', $data['phone_number']);
        })->when(isset($data['patasente_id']), function ($query) use ($data) {
            $query->orWhere('patasente_id', $data['patasente_id']);
        })->first();


        if ($user) {

            // Update null values
            $user->fill(array_filter($data, function ($value) {
                return $value !== null;
            }));
            $user->save();


            return $user;
        } else {
            return $this->store($data);
        }

    }


}
