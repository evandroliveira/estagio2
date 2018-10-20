<?php
session_start();
require 'vendor/autoload.php';
require 'config.php';
require 'essentials.php';

define('BASE_URL', 'http://localhost/estagio2');

spl_autoload_register(function ($class) {
    if (strpos($class, 'Controller') > -1) {
        if (file_exists('controllers/' . $class . '.php')) {
            require_once 'controllers/' . $class . '.php';
        }
    } elseif (file_exists('models/' . $class . '.php')) {
        require_once 'models/' . $class . '.php';
    } elseif (file_exists('core/' . $class . '.php')) {
        require_once 'core/' . $class . '.php';
    }
});

function debug($var)
{
    essentials::debug($var);
}

function dd($var)
{
    essentials::dd($var);
}

$core = new Core();
$core->run();
