<?php
namespace app\controllers;

class LoginController
{
    public function index()
    {
        view('login');
    }

    public function store()
    {
        var_dump('store')   ;
    }
}
