<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

return array(
    'URL' => 'http://' . $_SERVER['HTTP_HOST'] . str_replace('public', '', dirname($_SERVER['SCRIPT_NAME'])),
    'DB_TYPE' => 'mysql',
    'DB_HOST' => '127.0.0.1',
    'DB_NAME' => 'brime_main',
    'DB_USER' => 'root',
    'DB_PASS' => '',
    'DB_PORT' => '3306',
    'DB_CHARSET' => 'utf8',
);