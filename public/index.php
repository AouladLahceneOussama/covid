<?php

require_once '../vendor/autoload.php';

$request = $_SERVER['REQUEST_URI'];
$views = '../views/';

match ($request) {
    '/' => require $views . 'home.php',
    '/call' => require '../app/Src/Call.php',
    default => require $views . '404.php'
};
