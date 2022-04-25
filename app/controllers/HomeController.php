<?php
namespace app\controllers;

use app\framework\classes\Cache;
use app\models\Connect;

class HomeController
{
    public function index()
    {
        $cache = Cache::get('users', function () {
            $connect = Connect::connect();
            $users = $connect->query("select * from users");
            return $users->fetchAll();
        }, 5);

        view('home', ['users' => $cache,'name' => 'Alexandre']);
    }
}
