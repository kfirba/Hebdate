<?php

namespace Kfirba\Parsers\JewishDate;

use Kfirba\Parsers\Parser;

class DefaultParser extends Parser
{
    /**
     * Parse the request.
     *
     * @return mixed
     */
    public function parse()
    {
        return explode(' ', $this->date);
    }
}