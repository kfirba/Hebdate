<?php

use PHPUnit\Framework\TestCase;
use Kfirba\Formats\JewishDate\HebrewFull;

class HebrewFullTest extends TestCase
{
    /** @test */
    public function it_should_return_hebrew_representation_of_the_string()
    {
        $hebrew = new HebrewFull([9, 28, 5776]);

        $this->assertEquals(['כח', 'אייר', 'התשעו'], $hebrew->format());
    }

    /** @test */
    public function it_should_handle_adar_months_in_leap_year()
    {
        // 10 Adar II, 5776
        $hebrew = new HebrewFull([7, 10, 5776]);

        $this->assertEquals(['י', 'אדר ב', 'התשעו'], $hebrew->format());
    }
}
