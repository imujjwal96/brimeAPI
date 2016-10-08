<?php

class RegisterModel {

    public static function registerNewUser($userName, $email, $password) {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $query = $database->prepare($sql);
        $query->execute(array(
            ':username' => $userName,
            ':email' => $email,
            ':password' => $password));

        $userID = UserModel::getUserByUsername($userName)->id;

        if (!$userID) {
            return false;
        }

        $userVerificationCode = sha1(uniqid(mt_rand(), true));

        if (self::sendVerificationEmail($userID, $email, $userVerificationCode)) {
            return true;
        }

        return false;
    }

    public static function formValidation($userName, $email, $password, $passwordRepeat) {
        if (self::validateUserName($userName) AND self::validateEmail($email) AND self::validateUserPassword($password, $passwordRepeat)) {
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

    public static function sendVerificationEmail($userID, $userEmail, $userActivationHash) {
        $body = Config::get('EMAIL_VERIFICATION_CONTENT') . Config::get('URL') . Config::get('EMAIL_VERIFICATION_URL')
            . '/' . urlencode($userID) . '/' . urlencode($userActivationHash);

        $mail = new Mail;
        $mailSent = $mail->send($userEmail, Config::get('EMAIL_VERIFICATION_FROM_EMAIL'),
            Config::get('EMAIL_VERIFICATION_FROM_NAME'), Config::get('EMAIL_VERIFICATION_SUBJECT'), $body
        );

        if ($mailSent) {
            return true;
        } else {
            return false;
        }
    }

    public static function verifyNewUser($userID, $userVerificationCode) {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE users SET verified = 1, email_hash = NULL
                WHERE id = :userID AND emai_hash = :userVerificationCode LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':userID' => $userID, ':userVerificationCode' => $userVerificationCode));

        if ($query->rowCount() == 1) {
            return true;
        }

        return false;
    }
}