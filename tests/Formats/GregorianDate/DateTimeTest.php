<?php

use Domanage\Formats\GregorianDate\DateTime;

class DateTimeTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_returns_a_datetime_instance()
    {
        $formatter = new DateTime([6, 5, 2016]);

        $this->assertInstanceOf(\DateTime::class, $formatter->format());
    }
}