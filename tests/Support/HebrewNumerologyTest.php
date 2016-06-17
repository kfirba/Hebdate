<?php

use Kfirba\Support\HebrewNumerology;

class HebrewNumerologyTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var HebrewNumerology
     */
    protected $numerology;

    public function setUp()
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

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function it_should_throw_an_exception_given_a_bad_argument()
    {
        $this->numerology->sum('Englis H');
    }

    /** @test */
    public function it_should_return_the_hebrew_year_representation_of_a_number()
    {
        $this->assertEquals('התשעו', $this->numerology->toHebrewYear(5776));
        $this->assertEquals('תשעו', $this->numerology->toHebrewYear(776));
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function it_should_throw_an_exception_if_the_input_isnt_a_number()
    {
        $this->numerology->toHebrewYear('התשעו');
    }
}