<?php

namespace App\Services;

use GuzzleHttp\Client;

class GuzzleService
{
    protected $questionServiceDomain;
    protected $client;

    public function __construct(LogService $logService)
    {
        $this->logService = $logService;
        $this->questionServiceDomain = config('services.question_service.domain');
    }

    /**
     * Get instance of Guzzle\Client;
     */
    protected function getClient()
    {
        if (is_null($this->client)) {
            return new Client([
                'base_uri' => $this->questionServiceDomain,
            ]);
        }

        return $this->client;
    }

    /**
     * Call guzzle to question service by get method
     */
    public function get(string $uri)
    {
        $client = $this->getClient();

        $response = $client->get($uri);

        return json_decode($response->getBody());
    }

    /**
     * Call guzzle to question service by post method
     */
    public function post(string $uri, array $params)
    {
        $client = $this->getClient();

        $response = $client->request('POST', 'api/autos/info', [
            'json' => $params
        ]);

        return json_decode($response->getBody());
    }
}
