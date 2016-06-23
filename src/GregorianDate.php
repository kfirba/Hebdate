<?php

namespace Kfirba;

use DateTime;
use Carbon\Carbon;
use Kfirba\Parsers\GregorianDate\ArrayParser;
use Kfirba\Parsers\GregorianDate\CarbonParser;
use Kfirba\Parsers\GregorianDate\StringParser;
use Kfirba\Parsers\GregorianDate\DateTimeParser;

class GregorianDate extends Date
{
    /**
     * Named constructor.
     *
     * @param $date
     * @return static
     */
    public static function toJewish($date)
    {
        return new static($date);
    }

    /**
     * Instantiate a JewishDate object.
     *
     * @param $date
     * @return JewishDate
     */
    public static function fromJewish($date)
    {
        return new JewishDate($date);
    }

    /**
     * Parse the Date object and return a result based on format.
     *
     * @param string $delimiter
     * @return string
     */
    public function convert($delimiter = " ")
    {
        $julianDate = $this->toJulianDate();

        $jewishDate = $this->applyFormat(
            explode('/', jdtojewish($julianDate))
        );

        return implode($delimiter, $jewishDate);
    }

    /**
     * Get the julian date representation for the current date.
     *
     * @return int
     */
    protected function toJulianDate()
    {
        $gregorianDate = $this->getParser()->parse();
        list($gregorianDay, $gregorianMonth, $gregorianYear) = $gregorianDate;

        return gregoriantojd($gregorianDay, $gregorianMonth, $gregorianYear);
    }

    /**
     * Get the right parser for the date.
     *
     * @return CarbonParser|DateTimeParser|StringParser
     */
    protected function getParser()
    {
        if (is_array($this->date)) {
            return new ArrayParser($this->date);
        }

        if ($this->date instanceof Carbon) {
            return new CarbonParser($this->date);
        }

        if ($this->date instanceof DateTime) {
            return new DateTimeParser($this->date);
        }

        return new StringParser($this->date);
    }

    /**
     * Apply a format.
     *
     * @param array $jewishDate
     * @return mixed
     */
    protected function applyFormat(array $jewishDate)
    {
        $class = "Kfirba\\Formats\\JewishDate\\{$this->format}";

        return (new $class($jewishDate))->format();
    }
}