<?php

class Cookie
{
    private static $storage = array();

    public static function reader( $key )
    {
        if( isset( $_COOKIE[ $key ] ) )
        {
            return $_COOKIE[ $key ];
        }
        else
        {
            if( isset( static::$storage[$key] ) )
            return static::$storage[$key];
        }
    }

    public static function writer( $key, $value)
    {
        static::$storage[$key] = $value;
        setcookie( $key , $value , time() + (3600), '/');
    }
}