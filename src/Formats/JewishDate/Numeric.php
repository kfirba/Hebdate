<?php

namespace Domanage\Formats\JewishDate;

use Domanage\Parsers\Parser;

/**
 * Class Numeric
 *
 * @package Domanage\Parsers\JewishDate
 */
class Numeric extends Parser
{
    /**
     * Handle the parse request.
     *
     * @return array
     */
    public function handle()
    {
        // format it to dd,mm,yyyy
        return [$this->date[1], $this->date[0], $this->date[2]];
    }
}