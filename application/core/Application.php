<?php

class Application {

    protected $controller = 'IndexController';
    protected $method = 'index';
    protected $params = array();

    public function __construct() {
        $url = $this->parseURL();

        if (file_exists('../application/controllers/' . $url[0] . 'Controller.php')) {
            $this->controller = ucwords($url[0]) . 'Controller';
            unset($url[0]);
        }

        require_once '../application/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL() {
        if (isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}