<?php

namespace ZoomInfo\Models;

class LookupValues extends Model
{
    public $basePath = '';

    public function __construct($base, $basePath)
    {
        $this->basePath = $basePath;
        parent::__construct($base);
    }

    public function get($payload = [])
    {
        $response = $this->request->get();
        return array_column($response, 'Name', 'Id');
    }
}
