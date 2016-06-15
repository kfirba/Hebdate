<?php

use Domanage\JewishDate;
use Domanage\GregorianDate;

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
        $presentableHebrewDate = "כח׳ אייר התשע״ו";

        $this->assertEquals('05/06/2016', JewishDate::toGregorian($numericDate)->parse());
        $this->assertEquals('05/06/2016', JewishDate::toGregorian($englishMonthDate)->parse());
        $this->assertEquals('05/06/2016', JewishDate::toGregorian($hebrewFull)->parse());
        $this->assertEquals('05/06/2016', JewishDate::toGregorian($presentableHebrewDate)->parse());
    }
}