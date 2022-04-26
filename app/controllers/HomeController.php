<?php
namespace app\controllers;

use app\framework\classes\Cache;
use app\models\Connect;

class HomeController
{
    public function index()
    {
        // If you dont make any connection with the database,with this code(cache) you will get an error.
        $users = Cache::get('users', function () {
            $connect = Connect::connect();
            $users = $connect->query("select * from users");
            return $users->fetchAll();
        }, 5);

        view('home', ['users' => $users,'name' => 'Alexandre']);
    }
}
