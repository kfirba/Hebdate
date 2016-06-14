<?php

namespace Domanage\Formats\GregorianDate;

use Domanage\Formats\Format;

class Numeric extends Format
{
    /**
     * Handle the parse request.
     *
     * @return mixed
     */
    public function format()
    {
        return $this->pad()
            ->order();
    }

    protected function pad()
    {
        $this->date = array_map(function($segment) {
            return strlen($segment) === 1 ? '0' . $segment : $segment;
        }, $this->date);

        return $this;
    }

    protected function order()
    {
        return [$this->date[1], $this->date[0], $this->date[2]];
    }
}