<?php

use app\framework\classes\Engine;

function View(string $path, array $data = [])
{
    $engine = new Engine;
    echo $engine->render($path, $data);
}
