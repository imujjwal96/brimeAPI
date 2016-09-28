<?php

class LoginModel {

    public static function login($email, $password) {
        if(empty($email) OR empty($password)) {
            return false;
        }

        $result = UserModel::getUserByEmail($email);
        if (!$result) {
            return false;
        }

        if ($result->verifed != 1) {
            return false;
        }

        if (!password_verify($password, $result->password)) {
            return false;
        }

        return true;
    }

}