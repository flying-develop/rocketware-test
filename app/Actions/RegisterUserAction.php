<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Auth\Events\Registered;

class RegisterUserAction
{
    public function __invoke(array $data) : string
    {

        $user = User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['password'])
        ]);

        event(new Registered($user));

        return auth()->login($user);
    }
}