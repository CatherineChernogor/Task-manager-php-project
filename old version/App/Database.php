<?php

namespace App;

use PDO;

class Database
{

    protected static $_pdo;

    public static function get_pdo()
    {
        if (empty(static::$_pdo)) {
            $config = Config::get('database', [
                'host'   => 'localhost',
                'dbname' => 'test',
                'user'   => 'root',
                'password'  => '',
            ]);

            static::$_pdo = new PDO(
                'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'] . ';charset=utf8',
                $config['user'],
                $config['password']
            );
        }

        return static::$_pdo;
    }
}
