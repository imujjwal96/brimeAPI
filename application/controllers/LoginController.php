<?php

class LoginController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $message = 'Wrong place at the wrong time.';
        if (isset($_POST['email']) AND isset($_POST['p'])) {
            $email = $_POST['email'];
            $password = $_POST['p']; // The hashed password.

            $loginSuccessful = LoginModel::login($email, $password);

            if ($loginSuccessful === true) {
                http_response_code(200);
                $message = 'Logged in';
            } else {
                http_response_code(400);
                $message = $loginSuccessful;
            }
        }
        $this->View->renderJSON(array(
            'message' => $message
        ));
    }
}