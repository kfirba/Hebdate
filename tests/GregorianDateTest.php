<?php

use Carbon\Carbon;
use Domanage\GregorianDate;

class GregorianDateTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_should_accept_carbon_and_datetime_objects_as_well_as_strings_as_parameter()
    {
        $string = '05/06/2016';
        $dateTime = new DateTime('2016-06-05');
        $carbon = Carbon::createFromDate(2016, 6, 5);

        $this->assertEquals('28 9 5776', GregorianDate::toJewish($string)->parse());
        $this->assertEquals('28 9 5776', GregorianDate::toJewish($dateTime)->parse());
        $this->assertEquals('28 9 5776', GregorianDate::toJewish($carbon)->parse());
    }

    /** @test */
    public function it_should_format_the_date_according_to_given_format()
    {
        $englishMonth = GregorianDate::toJewish('05/06/2016')->format(GregorianDate::ENGLISH_MONTH)->parse();
        $hebrew = GregorianDate::toJewish(Carbon::createFromDate(2016, 6, 5))->format(GregorianDate::HEBREW_FULL)->parse();
        $hebrewDate = GregorianDate::toJewish('05/06/2016')->format(GregorianDate::PRESENTABLE_HEBREW_DATE)->parse();


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

        $this->assertEquals('10 7 5775', GregorianDate::toJewish($adar)->parse());
        $this->assertEquals('10 6 5776', GregorianDate::toJewish($adarI)->parse());
        $this->assertEquals('10 7 5776', GregorianDate::toJewish($adarII)->parse());
    }
}