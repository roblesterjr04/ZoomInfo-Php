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
            'base_uri' => "https://api.zoominfo.com/$endpoint/",
            'timeout' => $GLOBALS['zi_settings']['timeout'],
        ]);
        $this->authenticate();
    }

    public function __call($fn, $payload = null)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->token,
            'Content-type' => 'application/json'
        ];

        $body = [
            'json' => $payload ? $payload[0] : [],
            'headers' => $headers,
        ];
        if ($payload == null) unset($body['json']);

        $response = $this->client->$fn($this->model, $body);

        return json_decode($response->getBody());
    }

    private function authenticate()
	{
		$response = $this->client->post('https://api.zoominfo.com/authenticate', [
			'json' => $GLOBALS['zi_auth']
		]);
		$jwt = json_decode($response->getBody());
		$this->token = $jwt->jwt;
	}
}
