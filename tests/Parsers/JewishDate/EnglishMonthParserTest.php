<?php

use PHPUnit\Framework\TestCase;
use Kfirba\Parsers\JewishDate\EnglishMonthParser;

class EnglishMonthParserTest extends TestCase
{
    /** @test */
    public function it_parses_the_date_to_numeric_representation_substituting_the_english_month()
    {
        $parser = new EnglishMonthParser('28 Iyar 5776');

        $this->assertEquals([28, 9, 5776], $parser->parse());
    }
}
