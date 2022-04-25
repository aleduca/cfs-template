<?php

use app\framework\classes\Engine;

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
    $file = dirname(__FILE__, 2).DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.$file.'.'.$extension;
    if (!file_exists($file)) {
        throw new \Exception("Template {$file} does not exist");
    }
    return $file;
}
