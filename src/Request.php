<?php

namespace ZoomInfo;

use GuzzleHttp\Client;

class Request
{
    private $client;
    private $token;

    private $model;

    public function __construct($endpoint, $model)
    {
        $this->model = $model;
        $this->client = new Client([
            'base_uri' => "https://api.zoominfo.com/$endpoint/"
        ]);
        $this->authenticate();
    }

    public function __call($fn, $payload)
    {
        $payload = $payload ?: [''];
        $response = $this->client->$fn($this->model, [
            'json' => $payload[0],
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
                'Content-type' => 'application/json'
            ]
        ]);

        return json_decode($response->getBody());
    }

    private function authenticate()
	{
		$response = $this->client->post('https://api.zoominfo.com/authenticate', [
			'json' => $GLOBALS['auth']
		]);
		$jwt = json_decode($response->getBody());
		$this->token = $jwt->jwt;
	}
}
