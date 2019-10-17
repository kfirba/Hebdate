<?php

namespace Kfirba\Parsers\GregorianDate;

use Kfirba\Parsers\Parser;

class ArrayParser extends Parser
{
    /**
     * Parse the date.
     *
     * @return array
     */
    public function parse()
    {
        return [$this->date[1], $this->date[0], $this->date[2]];
    }
}
