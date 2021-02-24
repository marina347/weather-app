<?php

use PHPUnit\Framework\TestCase;
use Weather\ArgumentResolver;
use Weather\ErrorMessage;

/**
 * Contains tests for ArgumentResolver class
 */
class ArgumentResolverTest extends TestCase
{

    /**
     * Tests the use case when the argument does not contain special characters or numbers
     * @test
     */
    public function testResolveCity_ForValidArgument()
    {
        $expectedResult = 'Berlin';
        $mockedArgs = ['weather', $expectedResult];
        $argumentsResolver = new ArgumentResolver($mockedArgs);
        $result = $argumentsResolver->resolveCity();
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Tests the use case when the argument contains special characters or numbers
     * @test
     */
    public function testResolveCity_ForNonValidArgument()
    {
        $mockedArgs = ['weather', 'Berlin3#'];
        $argumentsResolver = new ArgumentResolver($mockedArgs);
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(ErrorMessage::ERROR_INVALID_CITY_ARGUMENT);
        $argumentsResolver->resolveCity();
    }

    /**
     * Tests the use case when the argument is not provided
     * @test
     */
    public function testResolveCity_ForNonExistingArgument()
    {
        $mockedArgs = ['weather'];
        $argumentsResolver = new ArgumentResolver($mockedArgs);
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(ErrorMessage::ERROR_MISSING_CITY_ARGUMENT);
        $argumentsResolver->resolveCity();
    }

}