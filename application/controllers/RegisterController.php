<?php

class RegisterController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if (isset($_POST['email'], $_POST['p'])) {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $userName = strip_tags($_POST['username']);
            $password = strip_tags($_POST["password"]);
            $passwordRepeat = strip_tags($_POST["passwordRepeat"]);
            if (!RegisterModel::formValidation($userName, $email, $password, $passwordRepeat)) {
                $this->View->renderJSON(array(
                    'message' => 'Invalid Credentials'
                ));
                return false;
            }
            if (!UserModel::getUserByEmail($email)) {
                $hash = md5(sha1(md5(sha1($email))));
                $password = password_hash($password, PASSWORD_BCRYPT);

                if (RegisterModel::registerNewUser($userName, $email, $password, $passwordRepeat)) {
                    $message = 'Registered Successfully';
                } else {
                    $message = 'Error with the database.';
                }
            } else {
                $message = 'User with email: ' . filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) . ' already exists.';
            }
        }
        $this->View->renderJSON(array(
            'message' => $message
        ));
    }
}