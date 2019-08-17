<?php
session_start();

$GLOBALS['config'] = array(
    'mysql'     => array(
        'host'  => 'localhost',
        'user'  => 'root',
        'pass'  => '',
        'db'    => 'lr'
    ),
    'remember'  => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800
    ),
    'session'   => array(
        'session_name'  => 'user',
        'token_name' => 'token'
    )
);



function autuoload($class)
{
    require "classes/$class.php";
}

spl_autoload_register('autuoload');

require 'functions/sanitize.php';
