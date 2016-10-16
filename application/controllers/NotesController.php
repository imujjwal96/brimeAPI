<?php

class NotesController extends Controller  {
    public function __construct() {
        parent::__construct();
    }

    public function index() {

    }

    public function add() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['title'], $_POST['content'], $_POST['label'], $_POST['author'])) {
                $title = strip_tags($_POST['title']);
                $content = strip_tags($_POST['content']);
                $label = strip_tags($_POST['label']);
                $author = strip_tags($_POST['author']);

                if (!NotesModel::addNote($title, $content, $label, $author)) {
                    Auth::setResponse(400);
                    $this->View->renderJSON(array(
                        'message' => 'Could not add note'
                    ));
                } else {
                    Auth::setResponse(200);
                    $this->View->renderJSON(array(
                        'message' => 'Note added successfully'
                    ));
                }
            }
        } else {
            Auth::setResponse(403);
            $this->View->renderJSON(array(
                'message' => 'You should not be here'
            ));
        }
    }
}