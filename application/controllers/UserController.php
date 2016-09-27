<?php

class UserController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if (Auth::content()["type"] == "Basic") {
            $authValue = explode(':', Auth::decrypt());

            $userInfo = UserModel::getUserByEmail($authValue[0]);
            if ($userInfo != false) {
                if (password_verify($authValue[1], $userInfo->password)) {
                    $this->View->renderJSON(array(
                        'id' => $userInfo->id,
                        'email' => $userInfo->email,
                        'firstName' => $userInfo->firstName,
                        'lastName' => $userInfo->lastName,
                        'birthDate' => $userInfo->birthDate
                    ));
                } else {
                    $this->View->renderJSON(array(
                        'message' => "Incorrect password"
                    ));
                }
            } else {
                $this->View->renderJSON(array(
                    'message' => "No such user"
                ));
            }

        } else {
            $this->View->renderJSON(array(
                'message' => "Requires Authentication"
            ));
        }
    }

    public function notes($access="public") {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $this->View->renderJSON(array(
                'message' => "Requires Authentication"
            ));
        } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($access == "public") {
                // Render Public Notes
            } elseif ($access == "private") {
                // Render Private Notes
            }
        }
    }
}