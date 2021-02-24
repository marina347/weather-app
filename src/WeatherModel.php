<?php

namespace Weather;

use DateTime;
use DateTimeZone;

/**
 * Entity for weather info for a city
 *
 * @package Weather
 */
class WeatherModel
{

    private string $city;
    private int $code;
    private string $main;
    private string $description;
    private float $currentTemperature;
    private float $feelsLikeTemperature;
    private float $minTemperature;
    private float $maxTemperature;
    private float $pressure;
    private float $humidity;
    private float $windSpeed;
    private string $sunset;
    private string $sunrise;
    private string $icon;

    /**
     * Builds WeatherModel object with provided input and city
     *
     * @param array $input Payload from weather API
     * @param string $city City for which the data is for
     * @throws \Exception
     */
    public function __construct(array $input, string $city)
    {
        $weatherInfo = $input['weather'][0];
        $weatherMainInfo = $input['main'];
        $weatherSysInfo = $input['sys'];

        $this->setCity($city);
        $this->setCode($weatherInfo['id']);
        $this->icon = Icon::getIconForCode($this->code);
        $this->setDescription($weatherInfo['description']);
        $this->setMain($weatherInfo['main']);
        $this->setCurrentTemperature($weatherMainInfo['temp']);
        $this->setFeelsLikeTemperature($weatherMainInfo['feels_like']);
        $this->setMinTemperature($weatherMainInfo['temp_min']);
        $this->setMaxTemperature($weatherMainInfo['temp_max']);
        $this->setHumidity($weatherMainInfo['humidity']);
        $this->setPressure($weatherMainInfo['pressure']);
        $this->setWindSpeed($input['wind']['speed']);
        $this->setSunrise((new DateTime(null,
            new DateTimeZone('Europe/Berlin')))->setTimestamp((int)$weatherSysInfo['sunrise'])->format('H:m:s'));
        $this->setSunset((new DateTime(null,
            new DateTimeZone('Europe/Berlin')))->setTimestamp((int)$weatherSysInfo['sunset'])->format('H:m:s'));
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->appendNewLines(
            "******** " . strtoupper($this->city) . " TODAY ********",
            $this->icon,
            "*** Main weather information ***",
            $this->main . " ( " . $this->description . " )",
            "Current temperature is " . $this->currentTemperature . "°C",
            "It feels like " . $this->feelsLikeTemperature . "°C",
            "Minimum temperature is " . $this->minTemperature . "°C",
            "Maximum temperature is " . $this->maxTemperature . "°C",
            "*** Additional weather information ***",
            "Pressure is " . $this->pressure . "hPa",
            "Humidity is " . $this->humidity . "%",
            "Wind speed is " . $this->windSpeed . "km/h",
            "Sun is rising at " . $this->sunrise . " GMT+1",
            "Sun is setting at " . $this->sunset . " GMT+1",
        );
    }

    /**
     * Adds new line to each input and joins into one string
     * @param string ...$lines Lines for which to append new line
     * @return string
     */
    private function appendNewLines(string ...$lines): string
    {
        $output = '';
        $rows = \array_map(fn($line) => $line . PHP_EOL, $lines);
        foreach ($rows as $row) {
            $output .= $row;
        }
        return $output;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param int $code
     */
    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    /**
     * @param string $main
     */
    public function setMain(string $main): void
    {
        $this->main = $main;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param float $currentTemperature
     */
    public function setCurrentTemperature(float $currentTemperature): void
    {
        $this->currentTemperature = $currentTemperature;
    }

    /**
     * @param float $feelsLikeTemperature
     */
    public function setFeelsLikeTemperature(float $feelsLikeTemperature): void
    {
        $this->feelsLikeTemperature = $feelsLikeTemperature;
    }

    /**
     * @param float $minTemperature
     */
    public function setMinTemperature(float $minTemperature): void
    {
        $this->minTemperature = $minTemperature;
    }

    /**
     * @param float $maxTemperature
     */
    public function setMaxTemperature(float $maxTemperature): void
    {
        $this->maxTemperature = $maxTemperature;
    }

    /**
     * @param float $pressure
     */
    public function setPressure(float $pressure): void
    {
        $this->pressure = $pressure;
    }

    /**
     * @param float $humidity
     */
    public function setHumidity(float $humidity): void
    {
        $this->humidity = $humidity;
    }

    /**
     * @param float $wind
     */
    public function setWindSpeed(float $windSpeed): void
    {
        $this->windSpeed = $windSpeed;
    }

    /**
     * @param string $sunset
     */
    public function setSunset(string $sunset): void
    {
        $this->sunset = $sunset;
    }

    /**
     * @param string $sunrise
     */
    public function setSunrise(string $sunrise): void
    {
        $this->sunrise = $sunrise;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

}