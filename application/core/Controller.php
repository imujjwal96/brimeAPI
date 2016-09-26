<?php

class Controller {

    public $View;

    public function __construct() {
        $this->View = new View();
    }

   /* public function model ($model) {
        require_once '../application/models/' . $model . '.php';
        return new $model();
    }

    public function view ($view, $data = array()) {
        require_once '../application/views/' . $view . '.php';
    }*/
}