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
     * Handle the parse request.
     *
     * @return array
     */
    public function handle()
    {
        $date = explode('-', $this->date->format('Y-m-d'));

        return [$date[1], $date[2], $date[0]];
    }
}