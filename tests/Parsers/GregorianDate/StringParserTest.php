<?php

use Kfirba\Parsers\GregorianDate\StringParser;

class StringParserTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_should_accept_3_types_of_delimiters_and_return_appropriate_array_of_the_date()
    {
        $parserDot = new StringParser('21.06.2016');
        $parserDash = new StringParser('21-06-2016');
        $parserSlash = new StringParser('21/06/2016');

        $this->assertEquals([06, 21, 2016], $parserDot->parse());
        $this->assertEquals([06, 21, 2016], $parserDash->parse());
        $this->assertEquals([06, 21, 2016], $parserSlash->parse());
    }
}