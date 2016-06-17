<?php

use Kfirba\Formats\JewishDate\Numeric;

class NumericTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_should_return_the_date_array_in_the_right_order()
    {
        $numeric = (new Numeric([9, 28, 5776]))->format();

        $this->assertEquals([28, 9, 5776], $numeric);
    }
}