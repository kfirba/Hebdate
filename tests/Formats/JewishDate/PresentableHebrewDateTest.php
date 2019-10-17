<?php

use PHPUnit\Framework\TestCase;
use Kfirba\Formats\JewishDate\PresentableHebrewDate;

class PresentableHebrewDateTest extends TestCase
{
    /** @test */
    public function it_should_return_formatted_hebrew_date()
    {
        $presentableHebrew = new PresentableHebrewDate([9, 28, 5776]);

        $this->assertEquals(['כח׳', 'אייר', 'התשע״ו'], $presentableHebrew->format());
    }
}
