<?php

$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

routerExecute();
