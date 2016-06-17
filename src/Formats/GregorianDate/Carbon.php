<?php

namespace Kfirba\Formats\GregorianDate;

use Carbon\Carbon as CarbonDate;
use Kfirba\Formats\Format;

class Carbon extends Format
{
    /**
     * Handle the parse request.
     *
     * @return mixed
     */
    public function format()
    {
        return new CarbonDate(implode('-', array_reverse($this->date)));
    }
}