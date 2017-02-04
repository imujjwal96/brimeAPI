<?php

namespace Brime\Auth;

use Brime\Models\User;

class Auth
{
    public function attempt($email, $password)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return false;
        }

        if (password_verify($password, $user->password)) {
            return true;
        }

        return false;
    }
}