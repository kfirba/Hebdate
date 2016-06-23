<?php

use Kfirba\Parsers\GregorianDate\DateTimeParser;

class DateTimeParserTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_should_parse_datetime_date_to_the_right_format()
    {
        $parser = new DateTimeParser(new DateTime('2016-06-05'));

        $this->assertEquals([06, 05, 2016], $parser->parse());
    }
}