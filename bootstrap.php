<?php

spl_autoload_register(function ($class) {
    include __DIR__ . '/'. str_replace('\\', '/', $class) . '.php';
});

function array_get($array, $key, $default = '')
{
    $array = (array)$array;
    if (isset($array[$key]))
    {
        return $array[$key];
    }

    return $default;
}

function selected_if($condition)
{
    if ($condition)
    {
        return ' selected';
    }
}

function checked_if($condition)
{
    if ($condition)
    {
        return ' checked';
    }
}


function view($template, $variables)
{
    extract($variables);
    include 'views/' . $template . '.php';
}

