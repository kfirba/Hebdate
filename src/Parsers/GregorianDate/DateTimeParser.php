<?php

namespace Kfirba\Parsers\GregorianDate;

use Kfirba\Parsers\Parser;

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