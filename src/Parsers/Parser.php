<?php

namespace Domanage\Parsers;

/**
 * Class Parser
 *
 * @package Domanage\Parsers
 */
abstract class Parser
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
     * Parse the date.
     *
     * @return mixed
     */
    public abstract function parse();
}