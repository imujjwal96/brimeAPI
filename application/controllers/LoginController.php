<?php

class LoginController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if (isset($_POST['email']) AND isset($_POST['p'])) {
            $email = $_POST['email'];
            $password = $_POST['p']; // The hashed password.

            if (LoginModel::login($email, $password)) {
                http_response_code(200);
                $message = 'Logged in';
            } else {
                http_response_code(400);
                $message = 'Incorect details';
            }
        }
        $this->View->renderJSON(array(
            'message' => $message
        ));
    }
}