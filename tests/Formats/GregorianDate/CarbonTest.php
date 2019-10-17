<?php

use PHPUnit\Framework\TestCase;
use Kfirba\Formats\GregorianDate\Carbon;

class CarbonTest extends TestCase
{
    /** @test */
    public function it_returns_carbon_instance()
    {
        $formatter = new Carbon([6, 5, 2016]);

        $this->assertInstanceOf(\Carbon\Carbon::class, $formatter->format());
    }
}
