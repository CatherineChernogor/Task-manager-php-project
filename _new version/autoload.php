<?php

spl_autoload_register(function ($class) {
    include __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
});

function array_get($array, $key, $default = '')
{
    $array = (array) $array;
    if (isset($array[$key])) {
        return $array[$key];
    }

    return $default;
}

function formatLocalTime($time)
{
    $time = strtotime($time);
    return date('Y-m-d\Th:i:s', $time);
}

function get_cur_status()
{
    return isset($_GET['status']) ? $_GET['status'] : 'all';
}
