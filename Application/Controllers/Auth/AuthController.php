<?php

namespace Brime\Controllers\Auth;

use Brime\Models\User;
use Brime\Controllers\Controller;
use Respect\Validation\Validator as v;

class AuthController extends Controller
{
    public function getSignIn($request, $response)
    {
        return $response->withJson(array(
            "message" => "Requires authentication"
        ), 401);
    }

    public function postSignIn($request, $response)
    {
        $validation = $this->validator->validate($request, [
            'email' => v::noWhitespace()->notEmpty()->email(),
            'password' => v::noWhitespace()->notEmpty(),
        ]);

        $auth = $this->auth->attempt(
            $request->getParam('email'),
            $request->getParam('p')
        );

        if (!$auth) {
            return $response->withJson(array(
                "errors" => "Invalid email or password"
            ), 400);
        }

        return $response->withJson(array(
            "message" => "Login successful."
        ), 200);
    }

    public function getSignUp($request, $response)
    {
        return $response->withJson(array(
            "message" => "Requires authentication"
        ), 401);
    }

    public function postSignUp($request, $response)
    {
        $validation = $this->validator->validate($request, [
            'email' => v::noWhitespace()->notEmpty()->email()->emailAvailable(),
            'password' => v::noWhitespace()->notEmpty(),
            'username' => v::noWhitespace()->notEmpty()->usernameAvailable(),
        ]);

        if ($validation->failed()) {
            return $response->withJson(array(
                "errors" => $validation->getErrors()
            ), 400);
        }

        $user = User::create([
            'email' => $request->getParam('email'),
            'password' => password_hash($request->getParam('p'), PASSWORD_DEFAULT),
            'username' => $request->getParam('username')
        ]);

        return $response->withJson(array(
            "message" => "Signup successful."
        ), 200);
    }
}