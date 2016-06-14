<?php

use Domanage\Formats\JewishDate\EnglishMonth;

class EnglishMonthTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_should_return_an_appropriate_formatted_date()
    {
        $englishMonth = new EnglishMonth([9, 28, 5776]);

        $this->assertEquals([28, 'Iyar', 5776], $englishMonth->handle());
    }

    /** @test */
    public function it_should_handle_leap_year_adar_months()
    {
        // 10 Adar II, 5776
        $englishMonth = new EnglishMonth([7, 10, 5776]);

        $this->assertEquals([10, 'Adar II', 5776], $englishMonth->handle());
    }
}