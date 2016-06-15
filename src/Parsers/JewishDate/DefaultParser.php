<?php

namespace Domanage\Parsers\JewishDate;

use Domanage\Parsers\Parser;

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