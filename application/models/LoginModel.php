<?php

class LoginModel {

    public static function login($email, $password) {
        if(empty($email) OR empty($password)) {
            return "Empty Email or Password";
        }

        $result = UserModel::getUserByEmail($email);
        if (!$result) {
            return "Could not find user with the given username";
        }

        if ($result->verified != 1) {
            return "user is not verified";
        }

        if (!password_verify($password, $result->password)) {
            return "password does not match";
        }

        return true;
    }

}