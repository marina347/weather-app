<?php

namespace Weather;

/**
 * Resolves input arguments from array
 *
 * @package Weather
 */
class ArgumentResolver
{

    /**
     * @var array Represents console parameters
     */
    private array $argv;

    /**
     * @param array $argv
     */
    public function __construct(array $argv)
    {
        $this->argv = $argv;
    }

    /**
     * Resolves city argument
     *
     * Checks if parameter on first index in array exists. Validates format of parameter.
     *
     * @return string
     */
    public function resolveCity(): string
    {
        if (!isset($this->argv[1])) {
            throw new \InvalidArgumentException(ErrorMessage::ERROR_MISSING_CITY_ARGUMENT);
        }

        if (preg_match("/[\[^\'£$%^&*()}{@:\'#~?><>;@\|\\\=\_+\¬\`\]0-9]/", $this->argv[1])) {
            throw new \InvalidArgumentException(ErrorMessage::ERROR_INVALID_CITY_ARGUMENT);
        }

        return $this->argv[1];
    }

}