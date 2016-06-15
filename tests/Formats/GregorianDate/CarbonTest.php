<?php

use Domanage\Formats\GregorianDate\Carbon;

class CarbonTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_returns_carbon_instance()
    {
        $formatter = new Carbon([6, 5, 2016]);

        $this->assertInstanceOf(\Carbon\Carbon::class, $formatter->format());
    }
}