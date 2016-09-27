<?php

class RegisterModel {

    public static function registerNewUser($userName, $email, $password, $passwordRepeat) {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
        $query = $database->prepare($sql);
        $query->execute(array(
            ':email' => $email,
            ':password' => $password));
        return true;
    }

    public static function formValidation($userName, $email, $password, $passwordRepeat) {
        if (self::validateUserName($userName) AND self::validateUserEmail($email) AND self::validateUserPassword($password, $passwordRepeat)) {
            return true;
        }

        return false;
    }

    public static function validateUserName($userName) {
        if (empty($userName)) {
            return false;
        }

        if (!preg_match('/^[a-zA-Z0-9]{2,64}$/', $userName)) {
            return false;
        }

        return true;
    }

    public static function validateEmail($email) {
        if (empty($email)) {
            return false;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }

    public static function validateUserPassword($password, $passwordRepeat) {
        if (empty($password) OR empty($passwordRepeat)) {
            return false;
        }

        if ($password !== $passwordRepeat) {
            return false;
        }

        if (strlen($password) < 6) {
            return false;
        }

        return true;
    }
}