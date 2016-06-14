<?php

use Domanage\HebrewDate;
use Domanage\GregorianDate;

class HebrewDateTest extends PHPUnit_Framework_TestCase
{
   /** @test */
   public function it_should_return_gregorian_date_instance_using_names_constructor()
   {
       $this->assertInstanceOf(GregorianDate::class, HebrewDate::fromGregorian('05/06/2016'));
   }
}