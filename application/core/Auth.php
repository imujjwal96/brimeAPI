<?php

class Auth {
    public static function affirmative() {
        if(isset(getallheaders()["Authorization"])) {
            return true;
        }
        return false;
    }

    public static function content() {
        if (self::affirmative()) {
            $authorization = explode(' ', getallheaders()["Authorization"]);
            return array(
                'type' => $authorization[0],
                'data' => $authorization[1]
            );
        }
        return false;
    }

    public static function decrypt() {

    }



}