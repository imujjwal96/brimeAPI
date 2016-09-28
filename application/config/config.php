<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

return array(
    'URL' => 'http://' . $_SERVER['HTTP_HOST'] . str_replace('public', '', dirname($_SERVER['SCRIPT_NAME'])),

    'PATH_CONTROLLER' => realpath(dirname(__FILE__).'/../../') . '/application/controllers/',
    'PATH_VIEW' => realpath(dirname(__FILE__).'/../../') . '/application/views/',

    'DEFAULT_CONTROLLER' => 'index',
    'DEFAULT_ACTION' => 'index',

    'DB_TYPE' => 'mysql',
    'DB_HOST' => '127.0.0.1',
    'DB_NAME' => 'brime_main',
    'DB_USER' => 'root',
    'DB_PASS' => '',
    'DB_PORT' => '3306',
    'DB_CHARSET' => 'utf8',

    'EMAIL_USED_MAILER' => 'phpmailer',
    'EMAIL_USE_SMTP' => false,
    'EMAIL_SMTP_HOST' => '',
    'EMAIL_SMTP_AUTH' => true,
    'EMAIL_SMTP_USERNAME' => '',
    'EMAIL_SMTP_PASSWORD' => '',
    'EMAIL_SMTP_PORT' => 465,
    'EMAIL_SMTP_ENCRYPTION' => 'ssl',

    'EMAIL_VERIFICATION_URL' => 'register/verify',
    'EMAIL_VERIFICATION_FROM_EMAIL' => 'no-reply@brime.tk',
    'EMAIL_VERIFICATION_FROM_NAME' => 'Brime',
    'EMAIL_VERIFICATION_SUBJECT' => 'Account activation for Brime',
    'EMAIL_VERIFICATION_CONTENT' => 'Please click on this link to activate your account: ',

);