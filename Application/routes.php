<?php

$app->get('/', 'HomeController:index')->setName('home');

$app->get('/api/v1/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');
$app->post('/api/v1/auth/signup', 'AuthController:postSignUp');

$app->get('/api/v1/auth/signin', 'AuthController:getSignIn')->setName('auth.signin');
$app->post('/api/v1/auth/signin', 'AuthController:postSignIn');