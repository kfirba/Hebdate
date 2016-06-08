<?php


use Domanage\Parsers\JewishDate\EnglishMonth;

class EnglishMonthTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_should_return_an_appropriate_formatted_date()
    {
        $formatter = new EnglishMonth([9, 28, 5776]);

        $this->assertEquals([28, 'Iyar', 5776], $formatter->handle());
    }
}