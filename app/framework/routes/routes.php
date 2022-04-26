<?php

return
    [
    'GET' =>
    [
        '/' => 'HomeController@index',
        '/login' => 'LoginController@index',
    ],
    'POST' => [
        '/login' => 'LoginController@store'
    ],
];
