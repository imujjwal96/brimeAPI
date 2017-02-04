<?php

namespace Brime\Controllers\Auth;

use Brime\Models\User;
use Brime\Controllers\Controller;
use Respect\Validation\Validator as v;

class AuthController extends Controller
{
    public function getSignUp($request, $response)
    {
        return $this->view->render($response, 'auth/signup.twig');
    }

    public function postSignUp($request, $response)
    {
        $validation = $this->validator->validate($request, [
            'email' => v::noWhitespace()->notEmpty()->email()->emailAvailable(),
            'password' => v::noWhitespace()->notEmpty(),
            'username' => v::noWhitespace()->notEmpty()->usernameAvailable(),
        ]);

        if ($validation->failed()) {
            return $this->view->render($response, 'auth/signup.twig');
        }

        $user = User::create([
            'email' => $request->getParam('email'),
            'password' => password_hash($request->getParam('p'), PASSWORD_DEFAULT),
            'username' => $request->getParam('username')
        ]);

    }
}