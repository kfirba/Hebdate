<?php

namespace Domanage\Parsers\JewishDate;

use Domanage\Parsers\Parser;

/**
 * Class EnglishMonthParser
 *
 * @package Domanage\Parsers\JewishDate
 */
class EnglishMonthParser extends Parser
{
    /**
     * Lookup table for hebrew months in english.
     *
     * @var array
     */
    const monthLookup = [
        ''        => 0,
        'Tishri'  => 1,
        'Heshvan' => 2,
        'Kislev'  => 3,
        'Tevet'   => 4,
        'Shevat'  => 5,
        'Adar I'  => 6,
        'Adar'    => 7,
        'Adar II' => 7,
        'Nisan'   => 8,
        'Iyar'    => 9,
        'Sivan'   => 10,
        'Tammuz'  => 11,
        'Av'      => 12,
        'Elul'    => 13
    ];

    /**
     * Handle the parse request.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->date = explode(' ', $this->date);

        return [$this->date[0], self::monthLookup[$this->date[1]], $this->date[2]];
    }
}