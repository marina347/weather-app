<?php

namespace Weather;

/**
 * Represents basic HTTP exception
 * @package Weather
 */
class HttpException extends \RuntimeException
{

    /**
     * @var int HTTP status code
     */
    private int $httpCode;

    /**
     * HttpException constructor.
     * @param string $message
     * @param int $httpCode
     * @param \Throwable|null $previous
     */
    public function __construct(string $message, int $httpCode, ?\Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
        $this->httpCode = $httpCode;
    }

    public function getHttpCode(): int
    {
        return $this->httpCode;
    }

}