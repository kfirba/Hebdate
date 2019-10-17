<?php

use PHPUnit\Framework\TestCase;
use Kfirba\Formats\JewishDate\Numeric;

class NumericTest extends TestCase
{
    /** @test */
    public function it_should_return_the_date_array_in_the_right_order()
    {
        $numeric = (new Numeric([9, 28, 5776]))->format();

        $this->assertEquals([28, 9, 5776], $numeric);
    }
}
