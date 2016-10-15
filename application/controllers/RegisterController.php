<?php

class RegisterController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $message = "Wrong place at the wrong time.";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['email'], $_POST['p'])) {
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                $userName = strip_tags($_POST['username']);
                $password = strip_tags($_POST["p"]);
                $passwordRepeat = strip_tags($_POST["p"]);
                if (!RegisterModel::formValidation($userName, $email, $password, $passwordRepeat)) {
                    Auth::setResponse(400);
                    $this->View->renderJSON(array(
                        'message' => 'Invalid Credentials'
                    ));
                    return false;
                }
                if (!UserModel::getUserByEmail($email)) {
                    $password = password_hash($password, PASSWORD_BCRYPT);

                    if (RegisterModel::registerNewUser($userName, $email, $password)) {
                        Auth::setResponse(200);
                        $message = 'Registered Successfully';
                    } else {
                        $message = 'Error with the database.';
                    }
                } else {
                    $message = 'User with email: ' . filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) . ' already exists.';
                }
            }
        }

        $this->View->renderJSON(array(
            'message' => $message
        ));
    }

    public function verify($userID, $userVerificationCode)
    {
        if (isset($userID) && isset($userVerificationCode)) {
            RegisterModel::verifyNewUser($userID, $userVerificationCode);
            Auth::setResponse(200);
            $message = 'Verified';
        } else {
            Auth::setResponse(400);
            $message = "Wrong place at the wrong time.";
        }
        $this->View->renderJSON(array(
            'message' => $message
        ));
    }
}