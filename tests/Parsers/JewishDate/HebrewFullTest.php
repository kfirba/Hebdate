<?php


use Domanage\Parsers\JewishDate\HebrewFull;

class HebrewFullTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_should_return_hebrew_representation_of_the_string()
    {
        $hebrew = (new HebrewFull([9, 28, 5776]))->handle();

        $this->assertEquals(['כח', 'אייר', 'התשעו'], $hebrew);
    }
}