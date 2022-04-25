<?php
namespace app\models;

use PDO;

class Connect
{
    private static $connect = null;

    public static function connect()
    {
        if (empty(self::$connect)) {
            self::$connect = new PDO("mysql:host={$_ENV['DATABASE_HOST']};dbname={$_ENV['DATABASE_DBNAME']}", $_ENV['DATABASE_USER'], $_ENV['DATABASE_PASSWORD'], [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ]);
        }

        return self::$connect;
    }
}
