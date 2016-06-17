<?php

namespace Kfirba\Formats\JewishDate;

use Kfirba\Formats\Format;

/**
 * Class Numeric
 *
 * @package Kfirba\Parsers\JewishDate
 */
class Numeric extends Format
{
    /**
     * Handle the parse request.
     *
     * @return array
     */
    public function format()
    {
        // format it to dd,mm,yyyy
        return [$this->date[1], $this->date[0], $this->date[2]];
    }
}