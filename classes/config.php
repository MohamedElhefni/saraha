<?php
class Config
{
    public static function get($path = null)
    {
        if ($path) {
            $config = $GLOBALS['config'];
            $path = explode('/', $path);

            foreach ($path as $bit) {
                if (isset($config[$bit]))
                    $config = $config[$bit];
            }

            return $config;
        }

        return false;
    }
}

/*
    Cofing Class v1.0.0 
    this class made for make it easy to access the $GLOBALS['config] in init file 
    like this mehtod
    config::get('mysql/host')  -----> 'localhost'
*/
