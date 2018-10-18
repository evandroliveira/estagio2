<?php
require 'environment.php';

global $config;
$config = array();
if (ENVIRONMENT == 'development') {
    $config['dbname'] = 'estagio1';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = '';
} else {
    $config['dbname'] = 'estagio1';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = '';
}
