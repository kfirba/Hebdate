<?php

use Carbon\Carbon;
use Kfirba\JewishDate;
use Kfirba\GregorianDate;
use Kfirba\Formats\Format;

class JewishDateTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_returns_GregorianDate_object_using_named_constructor()
    {
        $this->assertInstanceOf(GregorianDate::class, JewishDate::fromGregorian('05/06/2016'));
    }

    /** @test */
    public function it_should_convert_a_jewish_date_to_gregorian_date()
    {
        $numericDate = '28 9 5776';
        $englishMonthDate = '28 Iyar 5776';
        $hebrewFull = 'כח אייר התשעו';
        $hebrewShort = 'כח אייר תשעו';
        $presentableHebrewDate = "כח׳ אייר התשע״ו";

        $this->assertEquals('05/06/2016', JewishDate::toGregorian($numericDate)->convert());
        $this->assertEquals('05/06/2016', JewishDate::toGregorian($englishMonthDate)->convert());
        $this->assertEquals('05/06/2016', JewishDate::toGregorian($hebrewFull)->convert());
        $this->assertEquals('05/06/2016', JewishDate::toGregorian($hebrewShort)->convert());
        $this->assertEquals('05/06/2016', JewishDate::toGregorian($presentableHebrewDate)->convert());
    }

    /** @test */
    public function it_accepts_an_array_of_hebrew_date_in_various_formats_as_input()
    {
        $fullNumericArray = [28, 9, 5776];
        $englishMonthArray = [28, 'Iyar', 5776];
        $hebrewArray = ['כח', 'אייר', 'התשעו'];

        $this->assertEquals('05/06/2016', JewishDate::toGregorian($fullNumericArray)->convert());
        $this->assertEquals('05/06/2016', JewishDate::toGregorian($englishMonthArray)->convert());
        $this->assertEquals('05/06/2016', JewishDate::toGregorian($hebrewArray)->convert());
    }

    /** @test */
    public function it_accepts_multiple_formats()
    {
        $this->assertInstanceOf(Carbon::class,
            JewishDate::toGregorian('28 9 5776')->format(Format::CARBON)->convert()
        );

        $this->assertInstanceOf(DateTime::class,
            JewishDate::toGregorian('28 9 5776')->format(Format::DATETIME)->convert()
        );
    }
}