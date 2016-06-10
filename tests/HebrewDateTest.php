<?php

use Carbon\Carbon;
use Domanage\HebrewDate;

class HebrewDateTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_should_accept_carbon_and_datetime_objects_as_well_as_strings_as_parameter()
    {
        $string = '05/06/2016';
        $dateTime = new DateTime('2016-06-05');
        $carbon = Carbon::createFromDate(2016, 6, 5);

        $this->assertEquals('28 9 5776', HebrewDate::fromGregorian($string)->parse());
        $this->assertEquals('28 9 5776', HebrewDate::fromGregorian($dateTime)->parse());
        $this->assertEquals('28 9 5776', HebrewDate::fromGregorian($carbon)->parse());
    }

    /** @test */
    public function it_should_format_the_date_according_to_given_format()
    {
        $englishMonth = HebrewDate::fromGregorian('05/06/2016')->format(HebrewDate::ENGLISH_MONTH)->parse();
        $hebrew = HebrewDate::fromGregorian(Carbon::createFromDate(2016, 6, 5))->format(HebrewDate::HEBREW_FULL)->parse();
        $hebrewDate = HebrewDate::fromGregorian('05/06/2016')->format(HebrewDate::PRESENTABLE_HEBREW_DATE)->parse();


        $this->assertEquals('28 Iyar 5776', $englishMonth);
        $this->assertEquals('כח אייר התשעו', $hebrew);
        $this->assertEquals("כח׳ אייר התשע״ו", $hebrewDate);
    }

    /** @test */
    public function it_should_handle_adar_months_in_leap_year()
    {
        // 10 Adar, 5775
        $adar = '01.03.2015';
        // 10 Adar I, 5776
        $adarI = '19-02-2016';
        // 10 Adar II, 5776
        $adarII = '20/03/2016';

        $this->assertEquals('10 7 5775', HebrewDate::fromGregorian($adar)->parse());
        $this->assertEquals('10 6 5776', HebrewDate::fromGregorian($adarI)->parse());
        $this->assertEquals('10 7 5776', HebrewDate::fromGregorian($adarII)->parse());
    }
}