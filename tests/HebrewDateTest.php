<?php

use Carbon\Carbon;
use Domanage\HebrewDate;

class HebrewDateTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function a_gregorian_date_should_be_converted_to_hebrew_date()
    {
        $this->assertEquals(HebrewDate::fromGregorian('05/06/2016')->parse(), '28 9 5776');
    }

    /** @test */
    public function it_should_accept_carbon_and_datetime_objects_as_parameter()
    {
        $carbon = Carbon::createFromDate(2016, 6, 5);
        $dateTime = new DateTime('2016-06-05');

        $this->assertEquals(HebrewDate::fromGregorian($carbon)->parse(), '28 9 5776');
        $this->assertEquals(HebrewDate::fromGregorian($dateTime)->parse(), '28 9 5776');
    }

    /** @test */
    public function it_should_format_the_date_according_to_given_format()
    {
        $englishMonth = HebrewDate::fromGregorian('05/06/2016')->format(HebrewDate::ENGLISH_MONTH)->parse();
        $hebrew = HebrewDate::fromGregorian(Carbon::createFromDate(2016, 6, 5))->format(HebrewDate::HEBREW_FULL)->parse();

        $this->assertEquals($englishMonth, '28 Iyar 5776');
        $this->assertEquals($hebrew, 'כח אייר התשעו');
    }
}