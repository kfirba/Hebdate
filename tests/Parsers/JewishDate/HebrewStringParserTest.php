<?php

use PHPUnit\Framework\TestCase;
use Kfirba\Parsers\JewishDate\HebrewStringParser;

class HebrewStringParserTest extends TestCase
{
    /** @test */
    public function it_parses_the_hebrew_date_to_numeric_representation()
    {
        $parserClean = new HebrewStringParser('כח אייר התשעו');
        $parserFull = new HebrewStringParser('כח׳ אייר התשע״ו');

        $this->assertEquals([28, 9, 5776], $parserClean->parse());
        $this->assertEquals([28, 9, 5776], $parserFull->parse());
    }
}
