<?php

namespace App\Service;

use Doctrine\DBAL\Types\JsonType;
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

    public function getGenre(): array
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

    public function getTopRated(): array
    {
        $response = $this->client->request(
            'GET',
            $this->tmdbBaseUrl . '/movie/top_rated',
            [
                'query' => [
                    'api_key' => $this->tmdbKey,
                    'language' => 'fr-FR',
                ],
            ]
        );

        return $response->toArray();
    }

    public function getMovie(int $id)
    {
        $response = $this->client->request(
            'GET',
            $this->tmdbBaseUrl . '//movie/' . $id . '/videos',
            [
                'query' => [
                    'api_key' => $this->tmdbKey,
                ],
            ]
        );

        return $response->toArray();
    }
}