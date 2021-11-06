<?php

namespace App\Repository;

use App\Models\User;

class LoginRegistrationRepository implements LoginRegistrationInterface
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function register($request)
    {
      return $this->user::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'password' =>bcrypt($request['password'])
        ]);
    }


}
