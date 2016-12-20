<?php

$app->get('/', function ($request, $response) {
    return 'Index';
});

$app->get('/home', function ($request, $response) {
    return 'Home';
});