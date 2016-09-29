<?php

class View {

    public function renderJSON($data)
    {
        header("Content-Type: application/json");
        echo json_encode($data);
    }
}