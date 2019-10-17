<?php

namespace Kfirba\Formats\GregorianDate;

use Kfirba\Formats\Format;
use Carbon\Carbon as CarbonDate;

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
