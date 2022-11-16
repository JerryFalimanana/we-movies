<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiTmdb
{
    private $tmdbKey;
    private $tmdbBaseUrl;
    private $client;

    public function __construct($TMDB_KEY, $TMDB_BASE_URL, HttpClientInterface $client)
    {
        $this->tmdbKey = $TMDB_KEY;
        $this->tmdbBaseUrl = $TMDB_BASE_URL;
        $this->client = $client;
    }

    public function getData(): array
    {
        $response = $this->client->request(
            'GET',
            $this->tmdbBaseUrl . '/genre/movie/list',
            [
                'query' => [
                    'api_key' => $this->tmdbKey,
                    'language' => 'fr-FR',
                ],
            ]
        );

        return $response->toArray();
    }
}