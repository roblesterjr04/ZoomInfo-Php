<?php

namespace ZoomInfo\Endpoints;

abstract class Endpoint
{
    public $base;

    public function __construct($base)
    {
        $this->base = $base;

    }

    public function __get($key)
    {
        $classname = 'ZoomInfo\\Models\\' . ucwords($key);
        if ($key && class_exists($classname)) {
            return new $classname($this);
        }
    }

    public function __call($fn, $attributes)
    {
        $model = $this->$fn;

        return $model->get($attributes[0]);
    }

}
