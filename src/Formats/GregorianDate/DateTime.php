<?php

namespace Domanage\Formats\GregorianDate;

use Domanage\Formats\Format;
use DateTime as DateTimeDate;

class DateTime extends Format
{

    /**
     * Handle the parse request.
     *
     * @return mixed
     */
    public function format()
    {
        return new DateTimeDate(implode('-', array_reverse($this->date)));
    }
}