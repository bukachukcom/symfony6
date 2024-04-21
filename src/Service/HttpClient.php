<?php
namespace App\Service;

use GuzzleHttp\Client;

class HttpClient
{
    public function get(string $url): string
    {
        $client = new Client([
            'timeout'  => 15.0,
        ]);

        $response = $client->get($url);

        return $response->getBody()->getContents();
    }
}
