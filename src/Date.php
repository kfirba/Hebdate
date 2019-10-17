<?php

namespace Kfirba;


abstract class Date
{
    /**
     * Input date.
     *
     * @var string|array|\Carbon\Carbon|\DateTime
     */
    protected $date;

    /**
     * The default format for output.
     *
     * @var string
     */
    protected $format = 'Numeric';


    /**
     * Date constructor.
     *
     * @param $date
     */
    protected function __construct($date)
    {
        $this->date = $date;
    }

    /**
     * Set the format.
     *
     * @param $format
     * @return $this
     */
    public function format($format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * Parse the Date object and return a result based on format.
     *
     * @param  string  $delimiter
     * @return string
     */
    abstract public function convert($delimiter = ' ');

    /**
     * Get the julian date representation for the current date.
     *
     * @return int
     */
    abstract protected function toJulianDate();

    /**
     * Convert the HebrewDate object into its string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->convert();
    }
}
