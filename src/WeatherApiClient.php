<?php

namespace Weather;

use GuzzleHttp\Client;

/**
 * Contains logic for performing GET HTTP request against Open Weather Map API.
 *
 * @package Weather
 */
class WeatherApiClient
{

    /**
     * @var string API key
     */
    private string $weatherApiKey;

    /**
     * @var Client Low level HTTP client
     */
    private Client $client;

    /**
     * @param string $weatherApiKey
     * @param Client $client
     */
    public function __construct(string $weatherApiKey, Client $client)
    {
        $this->weatherApiKey = $weatherApiKey;
        $this->client = $client;
    }

    /**
     * Performs GET HTTP request
     *
     * Receives endpoint url and query parameters like city and performs GET request. Also adds API key and default unit to query parameters.
     * Checks if response is successful and tries to decode JSON response body.
     *
     * @param string $endpoint Represents API base url
     * @param array $queryParams Represents params that will be sent in request - city
     * @return array Decoded JSON
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function fetch(string $endpoint, array $queryParams): array
    {
        $queryParams['appid'] = $this->weatherApiKey;
        $queryParams['units'] = 'metric';

        $response = $this->client->get($endpoint, ['query' => $queryParams, 'http_errors' => false, 'verify' => true]);
        if ($response->getStatusCode() !== 200) {
            throw new HttpException(ErrorMessage::ERROR_FETCHING_WEATHER_DATA, $response->getStatusCode());
        }
        $responseBody = \json_decode($response->getBody(), true);
        if (\json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException(ErrorMessage::ERROR_INVALID_JSON);
        }
        return $responseBody;
    }

}