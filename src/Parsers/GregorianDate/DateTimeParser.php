<?php

namespace Domanage\Parsers\GregorianDate;

use Domanage\Parsers\Parser;

/**
 * Class DateTimeParser
 *
 * @package Domanage\Parsers\GregorianDate
 */
class DateTimeParser extends Parser
{
    /**
     * Parse the request.
     *
     * @return array
     */
    public function parse()
    {
        $date = explode('-', $this->date->format('Y-m-d'));

        return [$date[1], $date[2], $date[0]];
    }
}