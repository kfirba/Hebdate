<?php

namespace Domanage;

/**
 * Class HebrewDate
 *
 * @package Domanage
 */
class HebrewDate
{
    /**
     * Create a new GregorianDate instance with given date.
     *
     * @param $date
     * @return static
     */
    public static function fromGregorian($date)
    {
        return GregorianDate::toJewish($date);
    }
}