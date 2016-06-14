<?php

namespace Domanage\Formats;

abstract class Format
{
    /**
     * The input date.
     *
     * @var string|\Carbon\Carbon|\DateTime
     */
    protected $date;

    /**
     * Parser constructor.
     *
     * @param $date
     */
    public function __construct($date)
    {
        $this->date = $date;
    }

    /**
     * Handle the parse request.
     *
     * @return mixed
     */
    public abstract function format();
}