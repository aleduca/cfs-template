<?php

use app\framework\classes\Engine;
use app\framework\classes\Router;

// call the Engine to ender page
function View(string $path, array $data = [])
{
    $engine = new Engine;
    echo $engine->render($path, $data);
}

// to remove html tags in template
// you can use htmlentities with ENT_QUOTES or create another function
function escape(string $content)
{
    return strip_tags($content);
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
    $routes = require '../app/framework/routes/router.php';
    Router::execute($routes);
}
