<?php

namespace Kfirba\Formats\JewishDate;

use Kfirba\Formats\Format;

/**
 * Class EnglishMonth
 *
 * @package Kfirba\Parsers\JewishDate
 */
class EnglishMonth extends Format
{
    /**
     * Lookup table for hebrew months in english.
     *
     * @var array
     */
    const EnglishLookup = [
        '',
        'Tishri',
        'Heshvan',
        'Kislev',
        'Tevet',
        'Shevat',
        'Adar I',
        ['Adar', 'Adar II'],
        'Nisan',
        'Iyar',
        'Sivan',
        'Tammuz',
        'Av',
        'Elul'
    ];

    /**
     * Handle the parse request.
     *
     * @return array
     */
    public function format()
    {
        $month = self::EnglishLookup[$this->date[0]];

        // if we got Adar/Adar II, we need to determine whether it's a leap year or not
        if (is_array($month)) {
            $month = isJewishLeapYear($this->date[2]) ? $month[1] : $month[0];
        }

        return [$this->date[1], $month, $this->date[2]];
    }
}