<?php

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Weather\ErrorMessage;
use Weather\WeatherApiClient;
use Weather\HttpException;

/**
 * Contains tests for WeatherApiClient class
 */
class WeatherApiClientTest extends TestCase
{

    protected WeatherApiClient $weatherApiClient;

    /**
     * @var MockHandler Mocked Guzzle engine via which we can easily mock requests
     */
    protected MockHandler $mockHandler;

    /**
     * Prepares mock handler and weather api client
     */
    protected function setUp(): void
    {
        $this->mockHandler = new MockHandler();
        $httpClient = new Client([
            'handler' => $this->mockHandler,
        ]);
        $this->weatherApiClient = new WeatherApiClient('', $httpClient);
    }

    /**
     * Tests the use case when fetch handles success response
     * @test
     */
    public function testFetch_DecodesResponseForStatus200()
    {
        $expectedResult = ['weather' => [['description' => 'Sunny']]];
        $this->mockHandler->append(new Response(200, [], json_encode($expectedResult)));
        $result = $this->weatherApiClient->fetch('endpoint', ['test' => 'test']);
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Tests the use case when fetch handles success response with malformed JSON
     * @test
     */
    public function testFetch_FailsOnMalformedJson()
    {
        $this->mockHandler->append(new Response(200, [], "{}}"));
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(ErrorMessage::ERROR_INVALID_JSON);
        $this->weatherApiClient->fetch('endpoint', ['test' => 'test']);
    }

    /**
     * Tests the use case when fetch handles error response
     * @test
     */
    public function testFetch_FailsForStatusNon200()
    {
        $this->mockHandler->append(new Response(404, [], "{}"));
        $this->expectException(HttpException::class);
        $this->expectExceptionMessage(ErrorMessage::ERROR_FETCHING_WEATHER_DATA);
        $this->weatherApiClient->fetch('endpoint', ['test' => 'test']);
    }

}