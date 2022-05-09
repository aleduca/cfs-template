<?php

use app\framework\classes\Engine;
use app\framework\classes\Macros;
use app\framework\classes\Router;

// call the Engine to ender page
function View(string $path, array $data = [])
{
    $engine = new Engine;
    $engine->dependencies([new Macros]);
    echo $engine->render($path, $data);
}

// to get the view path
function getViewPath(string $file, string $extension):string
{
    $file = dirname(__FILE__, 2).'/resources/views/'.$file.'.'.$extension;
    if (!file_exists($file)) {
        throw new \Exception("Template {$file} does not exist");
    }
    return $file;
}

// to instance controller and call the action (maybe put in a class)
function routerExecute()
{
    try {
        $routes = require '../app/framework/routes/routes.php';
        $router = new Router;
        $router->execute($routes);
    } catch (\Throwable $th) {
        echo $th->getMessage();
    }
}

// convenient way to get uri

function path($index = 'path')
{
    return parse_url($_SERVER['REQUEST_URI'])[$index];
}

// convenient way to request method
function request()
{
    return $_SERVER['REQUEST_METHOD'];
}
