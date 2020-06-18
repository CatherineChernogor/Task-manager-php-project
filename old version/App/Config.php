<?php

namespace App;

class Config
{

    protected static $config_file = 'config.php';

    protected static $config;

    public static function get($param, $default = null)
    {
        Config::load();

        return array_get(static::$config, $param, $default);
    }

    protected static function load()
    {
        if (static::$config === null) {
            if (file_exists(static::$config_file)) {
                static::$config = include(static::$config_file);
            } else {
                static::$config = [];
            }
        }
    }
}
