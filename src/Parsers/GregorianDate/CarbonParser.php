<?php

namespace Kfirba\Parsers\GregorianDate;

use Kfirba\Parsers\Parser;

/**
 * Class CarbonParser
 *
 * @package Kfirba\Parsers\GregorianDate
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