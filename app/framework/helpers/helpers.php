<?php

use app\framework\classes\Engine;

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
