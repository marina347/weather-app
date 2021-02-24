<?php

namespace Weather;

use GuzzleHttp\Client;

/**
 * Represents the application. Contains small boot logic and run logic.
 *
 * @package Weather
 */
class App
{

    private WeatherApiClient $weatherApiClient;
    private ArgumentResolver $argumentResolver;

    /**
     * Boots the application.
     *
     * Reads config from env variables, and prepares all dependencies of the app.
     *
     * @param array $argv
     */
    function init(array $argv): void
    {
        $this->argumentResolver = new ArgumentResolver($argv);
        $weatherApiKey = getenv('WEATHER_API_KEY');
        $baseUrl = getenv('BASE_URL');
        if (!$weatherApiKey || !$baseUrl) {
            throw new \RuntimeException(ErrorMessage::ERROR_MISSING_CONFIG);
        }
        $this->weatherApiClient = new WeatherApiClient(
            $weatherApiKey,
            new Client(
                [
                    'base_uri' => $baseUrl,
                    'timeout' => 5,
                    'allow_redirects' => false,
                ]
            )
        );
    }

    /**
     * Runs the application
     *
     * Resolves arguments, executes API request and outputs the weather data to console.
     */
    function run(): void
    {
        try {
            $city = $this->argumentResolver->resolveCity();
            $result = $this->weatherApiClient->fetch('weather', ['q' => $city]);
            $weatherModel = new WeatherModel($result, $city);
            echo $weatherModel;
        } catch (HttpException $e) {
            if ($e->getHttpCode() === 401) {
                $this->error(ErrorMessage::ERROR_API_KEY_INVALID);
            } elseif ($e->getHttpCode() === 404) {
                $this->error(ErrorMessage::ERROR_CITY_NOT_FOUND);
            } else {
                $this->error(ErrorMessage::ERROR_GENERAL);
            }
        } catch (\Throwable $e) {
            if (\in_array($e->getMessage(), ErrorMessage::ERRORS)) {
                $this->error($e->getMessage());
            }
            $this->error(ErrorMessage::ERROR_GENERAL);
        }
    }

    /**
     * Prints error message and stops the application.
     *
     * @param string $message
     */
    private function error(string $message): void
    {
        echo $message . PHP_EOL;
        exit(1);
    }

}