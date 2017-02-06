<?php

namespace Brime\Controllers;

use Brime\Models\User;

class HomeController extends Controller
{
    public function index($request, $response)
    {
        return $this->view->render($response, 'home.twig');
    }
}