<?php

use PHPUnit\Framework\TestCase;
use Kfirba\Support\HebrewNumerology;

class HebrewNumerologyTest extends TestCase
{
    /**
     * @var HebrewNumerology
     */
    protected $numerology;

    public function setUp(): void
    {
        $this->numerology = new HebrewNumerology;
    }

    /** @test */
    public function it_should_return_the_numerical_value_of_a_hebrew_string()
    {
        $this->assertEquals(776, $this->numerology->sum('תשעו'));
    }

    /** @test */
    public function it_should_respect_hebrew_years_with_preceding_H()
    {
        $this->assertEquals(5776, $this->numerology->sum('התשעו', true));
    }

    /** @test */
    public function it_should_throw_an_exception_given_a_bad_argument()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->numerology->sum('Englis H');
    }

    /** @test */
    public function it_should_return_the_hebrew_year_representation_of_a_number()
    {
        $this->assertEquals('התשעו', $this->numerology->toHebrewYear(5776));
        $this->assertEquals('תשעו', $this->numerology->toHebrewYear(776));
    }

    /** @test */
    public function it_should_throw_an_exception_if_the_input_isnt_a_number()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->numerology->toHebrewYear('התשעו');
    }
}
