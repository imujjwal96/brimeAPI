<?php

class IndexController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->View->renderJSON(array(
            'current_user_url' => 'https://api.brime.tk/user',
        ));
    }
}