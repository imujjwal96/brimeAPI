<?php

class UserController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
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