<?php

class Application {

    protected $controller;
    protected $method;
    protected $params = array();
    private $controllerName;

    public function __construct() {
        $url = $this->parseURL();

        if (!$this->controllerName) {
            $this->controllerName = Config::get('DEFAULT_CONTROLLER');
        }

        if (!$this->method OR (strlen($this->method) == 0)) {
            $this->method = Config::get('DEFAULT_ACTION');
        }

        $this->controllerName = ucwords($this->controllerName) . 'Controller';

        if (file_exists(Config::get('PATH_CONTROLLER') . $this->controllerName . '.php')) {

            require Config::get('PATH_CONTROLLER') . $this->controllerName . '.php';
            $this->controller = new $this->controllerName();

            if (method_exists($this->controller, $this->method)) {
                if (!empty($this->params)) {
                    call_user_func_array(array($this->controller, $this->method), $this->params);
                } else {
                    $this->controller->{$this->method}();
                }
            } else {
                // Error 404
            }
        } else {
            // Error 404
        }


        /*

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

        call_user_func_array([$this->controller, $this->method], $this->params);*/
    }

    public function parseURL() {
        if (isset($_GET['url'])) {
            $url = trim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            $this->controllerName = isset($url[0]) ? $url[0] : null;
            $this->method = isset($url[1]) ? $url[1] : null;

            unset($url[0], $url[1]);

            $this->params = array_values($url);
        }
    }
}