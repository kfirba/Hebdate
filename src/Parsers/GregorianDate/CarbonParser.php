<?php

namespace Domanage\Parsers\GregorianDate;

use Domanage\Parsers\Parser;

/**
 * Class CarbonParser
 *
 * @package Domanage\Parsers\GregorianDate
 */
class CarbonParser extends Parser
{
    /**
     * Parse the request.
     *
     * @return array
     */
    public function parse()
    {
        $date = explode('-', $this->date->toDateString());

        return [$date[1], $date[2], $date[0]];
    }
}