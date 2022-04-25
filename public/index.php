<?php

require '../vendor/autoload.php';

$routes = [
    'GET' =>
    [
        '/' => 'HomeController@index',
        '/login' => 'LoginController@index'
    ],
    'POST' => [
        '/login' => 'LoginController@store'
    ]
];

$path = $_SERVER['REQUEST_URI'];
$request = $_SERVER['REQUEST_METHOD'];

if (!isset($routes[$request])) {
    throw new Exception("Route does not exist");
}

if (!isset($routes[$request][$path])) {
    throw new Exception("Route does not exist");
}

[$controller, $action] = explode('@', $routes[$request][$path]);

$controllerNamespace = "app\\controllers\\{$controller}";

if (!class_exists($controllerNamespace)) {
    throw new Exception("Controller {$controller} does not exist");
}

if (!class_exists($controllerNamespace, $action)) {
    throw new Exception("Method {$action} does not exist on controller {$controller}");
}

$controllerInstance = new $controllerNamespace;
$controllerInstance->$action();
