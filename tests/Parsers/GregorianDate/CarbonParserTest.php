<?php

use Carbon\Carbon;
use Domanage\Parsers\GregorianDate\CarbonParser;

class CarbonParserTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_should_parse_carbon_date_to_the_right_format()
    {
        $parser = new CarbonParser(Carbon::create(2016, 6, 5));

        $this->assertEquals([06, 05, 2016], $parser->parse());
    }
}