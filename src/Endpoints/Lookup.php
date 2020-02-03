<?php

namespace ZoomInfo\Endpoints;

use ZoomInfo\Models\LookupValues;

class Lookup extends Endpoint
{
    public $basePath = 'lookup';

    public function __get($key)
    {
        return new LookupValues($this, $key);
    }
}
