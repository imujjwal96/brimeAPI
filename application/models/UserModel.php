<?php

class UserModel {
    public static function getUserByID($userID) {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM users WHERE id = :userID";
        $query = $database->prepare($sql);
        $query->execute(array(':userID' => $userID));

        if ($query->rowCount() == 1) {
            return $query->fetch();
        }
        return false;
    }

    public static function getUserByEmail($email) {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM users WHERE email = :email";
        $query = $database->prepare($sql);
        $query->execute(array(':email' => $email));

        if ($query->rowCount() == 1) {
            return $query->fetch();
        }
        return false;
    }

    public static function getUserByUsername($userName) {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM users WHERE username = :username";
        $query = $database->prepare($sql);
        $query->execute(array(':username' => $userName));

        if ($query->rowCount() == 1) {
            return $query->fetch();
        }
        return false;
    }
}