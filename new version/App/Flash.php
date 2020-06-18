<?php

namespace App;

class Flash {

    public static function set($message)
    {
        Session::set('flash_message', $message);
    }

    public static function get()
    {
        $message = Session::get('flash_message');

        if ( ! empty($message))
        {
            Session::forget('flash_message');
        }

        return $message;
    }

}
