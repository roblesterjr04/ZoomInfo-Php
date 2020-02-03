<?php

namespace ZoomInfo;

class ZoomInfo
{
    public function __construct(Array $auth, $settings = [])
    {

        $defaults = [
            'timeout' => 30,
        ];

        $GLOBALS['zi_settings'] = array_merge($defaults, $settings);
        $GLOBALS['zi_auth'] = $auth;

    }

    public function __get($key)
    {
        $classname = 'ZoomInfo\\Endpoints\\' . ucwords($key);
        if ($key && class_exists($classname)) {
            return new $classname($this);
        }
    }

}
