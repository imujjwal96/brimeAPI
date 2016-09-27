<?php

class UserController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if (Auth::content()["type"] == "Basic") {
            echo Auth::content()["data"];
        }


       /* if (Auth::affirmative()) {
            if (strcmp(Auth::type(), "basic")) {

            }
            $authorization = explode(' ', getallheaders()["Authorization"]);
            if (strcmp($authorization[0], "basic")) {
                $basicAuth = explode(':', base64_decode($authorization[1]));
            }
        }*/
        //Authorization: Basic aW11amp3YWw5NjpBdHVsX2JoYXI3MDI=
       // $baseAuth = base64_decode();
/*
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $this->View->renderJSON(array(
                'message' => "Requires Authentication"
            ));
        }*/
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