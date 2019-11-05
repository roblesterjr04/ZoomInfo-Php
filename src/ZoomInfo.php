<?php

namespace ZoomInfo;

class ZoomInfo
{
    public function __construct(Array $auth)
    {

        $GLOBALS['auth'] = $auth;

    }

    public function __get($key)
    {
        $classname = 'ZoomInfo\\Endpoints\\' . ucwords($key);
        if ($key && class_exists($classname)) {
            return new $classname($this);
        }
    }

}
