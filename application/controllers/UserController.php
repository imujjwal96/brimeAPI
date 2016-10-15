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
                    Auth::setResponse(200);
                    $this->View->renderJSON(array(
                        'id' => $userInfo->id,
                        'email' => $userInfo->email,
                        'firstName' => $userInfo->firstName,
                        'lastName' => $userInfo->lastName,
                        'birthDate' => $userInfo->birthDate
                    ));
                } else {
                    http_response_code(400);
                    $this->View->renderJSON(array(
                        'message' => "Incorrect password"
                    ));
                }
            } else {
                Auth::setResponse(404);
                $this->View->renderJSON(array(
                    'message' => "No such user"
                ));
            }

        } else {
            Auth::setResponse(401);
            $this->View->renderJSON(array(
                'message' => "Requires Authentication"
            ));
        }
    }

    public function notes() {
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method == 'GET') {
            if (Auth::content()["type"] == "Basic") {
                $authValue = explode(':', Auth::decrypt());

                $userInfo = UserModel::getUserByEmail($authValue[0]);
                if ($userInfo != false) {
                    if (password_verify($authValue[1], $userInfo->password)) {
                        $notes = NotesModel::getNotesByUser($userInfo->id);
                        Auth::setResponse(200);
                        $this->View->renderJSON($notes);
                    } else {
                        http_response_code(400);
                        $this->View->renderJSON(array(
                            'message' => "Incorrect authentication."
                        ));
                    }
                } else {
                    Auth::setResponse(404);
                    $this->View->renderJSON(array(
                        'message' => "No such user"
                    ));
                }

            } else {
                Auth::setResponse(401);
                $this->View->renderJSON(array(
                    'message' => "Requires Authentication"
                ));
            }
        } elseif ($method == 'POST') {
            // Add note
        } elseif ($method == 'DELETE') {
            // Delete note
        } elseif ($method == 'PUT') {
            // Update note
        }
    }
}