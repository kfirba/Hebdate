<?php

use PHPUnit\Framework\TestCase;
use Kfirba\Formats\GregorianDate\Numeric;

class GregorianNumericTest extends TestCase
{
    /** @test */
    public function it_pads_and_reorder_the_date()
    {
        $formatter = new Numeric([6, 5, 2016]);

        $this->assertEquals(['05', '06', '2016'], $formatter->format());
    }
}
