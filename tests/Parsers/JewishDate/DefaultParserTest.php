<?php

use Kfirba\Parsers\JewishDate\DefaultParser;

class DefaultParserTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_explodes_the_date()
    {
        $parser = new DefaultParser('28 9 5776');

        $this->assertEquals([28, 9, 5776], $parser->parse());
    }
}