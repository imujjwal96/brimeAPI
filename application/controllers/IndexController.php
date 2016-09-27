<?php

class IndexController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->View->renderJSON(array(
            'current_user_url' => 'http://api.brime.tk/user',
            'public_notes_url' => 'http://api.brime.tk/user/private',
            'private_notes_url' => 'http://api.brime.tk/user/public'
        ));
    }
}