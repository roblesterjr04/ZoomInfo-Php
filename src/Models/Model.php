<?php

namespace ZoomInfo\Models;

use GuzzleHttp\Client;
use ZoomInfo\Request;

abstract class Model
{
    private $base;
    protected $request;

    public $basePath;

    public function __construct($base)
    {
        $this->base = $base;

        $this->request = new Request($base->basePath, $this->basePath, $base->base->auth);
    }

    public function getFields($type = "input")
    {
        $fieldRequest = new Request("lookup/{$type}fields/{$this->basePath}", $this->base->basePath, $this->base->base->auth);

        return $fieldRequest->get();
    }

    public function get($payload = [])
    {
        $response = $this->request->post($payload);
        return $response;
    }
}
