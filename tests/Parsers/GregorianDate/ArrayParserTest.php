<?php

use Kfirba\Parsers\GregorianDate\ArrayParser;

class ArrayParserTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_should_parse_an_array_to_the_right_format()
    {
        $parser = new ArrayParser([05, 06, 2016]);

        $this->assertEquals([06, 05, 2016], $parser->parse());
    }
}