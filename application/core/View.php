<?php

class View {

    public function render($view, $data = null)
    {
        if ($data) {
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        }

        require_once '../application/views/' . '_templates/header.php';
        require_once '../application/views/' . $view . '.php';
        require_once '../application/views/' . '_templates/footer.php';
    }

    public function renderWithoutHeaderAndFooter($view, $data = null)
    {
        if ($data) {
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        }

        require '../application/views/' . $view . '.php';
    }

    public function renderJSON($data)
    {
        header("Content-Type: application/json");
        echo json_encode($data);
    }


    /**
     * Converts characters to HTML entities
     * This is important to avoid XSS attacks, and attempts to inject malicious code in your page.
     *
     * @param  string $str The string.
     * @return string
     */
    public function encodeHTML($str)
    {
        return htmlentities($str, ENT_QUOTES, 'UTF-8');
    }
}