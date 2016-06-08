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
     * Handle the parse request.
     *
     * @return array
     */
    public function handle()
    {
        $date = explode('-', $this->date->toDateString());

        return [$date[1], $date[2], $date[0]];
    }
}