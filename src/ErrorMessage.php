<?php

namespace Weather;

/**
 * Contains error messages
 * @package Weather
 */
class ErrorMessage
{

    public const ERRORS = [
        self::ERROR_MISSING_CONFIG,
        self::ERROR_API_KEY_INVALID,
        self::ERROR_CITY_NOT_FOUND,
        self::ERROR_INVALID_JSON,
        self::ERROR_FETCHING_WEATHER_DATA,
        self::ERROR_INVALID_CITY_ARGUMENT,
        self::ERROR_MISSING_CITY_ARGUMENT,
        self::ERROR_GENERAL
    ];

    public const ERROR_MISSING_CITY_ARGUMENT = 'Provide city as an argument';
    public const ERROR_INVALID_CITY_ARGUMENT = 'Provide city argument in right format - letters, spaces and hyphens are allowed';
    public const ERROR_INVALID_JSON = 'Invalid Json';
    public const ERROR_FETCHING_WEATHER_DATA = 'Error while fetching weather data';

    public const ERROR_CITY_NOT_FOUND = 'City not found. Please correct your input';
    public const ERROR_API_KEY_INVALID = 'API key is not invalid. Check the configuration';
    public const ERROR_MISSING_CONFIG = 'Cannot boot application, missing config';
    public const ERROR_GENERAL = 'Unknown error occured';

}