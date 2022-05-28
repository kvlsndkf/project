<?php

class Cookie
{
    //attribute
    private static $storage = array();

    /**
     * @method reader() save cookies by 
     * @param string $key 
     */
    public static function reader($key)
    {
        if (isset($_COOKIE[$key])) {
            return $_COOKIE[$key];
        } else {
            if (isset(static::$storage[$key]))
                return static::$storage[$key];
        }
    }

    /**
     * @method reader() read cookies by 
     * @param string $key 
     * @param string $value 
     */
    public static function writer($key, $value)
    {
        static::$storage[$key] = $value;
        setcookie($key, $value, time() + (3600), '/');
    }

    /**
     * @method reader() delete cookies by 
     * @param string $key 
     */
    public static function delete($key)
    {
        setcookie($key, '', time() - (3600), '/');
    }
}
