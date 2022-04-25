<?php
namespace app\controllers;

use app\framework\classes\Cache;

class LoginController
{
    public function index()
    {
        $data = Cache::get('name',function(){
            return ['name' => 'Joao'];
        }, 5);

        view('login',$data);
    }

    public function store()
    {
        var_dump('store')   ;
    }
}
