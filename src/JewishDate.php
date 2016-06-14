<?php

namespace Domanage;

use Domanage\Parsers\JewishDate\DefaultParser;
use Domanage\Parsers\JewishDate\HebrewStringParser;

class JewishDate extends Date
{
    /**
     * Named constructor.
     *
     * @param $date
     * @return static
     */
    public static function toGregorian($date)
    {
        return new static($date);
    }

    /**
     * Parse the Date object and return a result based on format.
     *
     * @param string $delimiter
     * @return string
     */
    public function parse($delimiter = '/')
    {
        $julianDate = $this->toJulianDate();

        $gregorianDate = $this->applyFormat(
            explode('/', jdtogregorian($julianDate))
        );

        return implode($delimiter, $gregorianDate);
    }

    /**
     * Get the julian date representation for the current date.
     *
     * @return int
     */
    protected function toJulianDate()
    {
        $numericDate = $this->getParser()->handle();
        list($day, $month, $year) = $numericDate;

        return jewishtojd($month, $day, $year);
    }

    public function getParser()
    {
        if (preg_match('/[א-ת]/', $this->date)) {
            return new HebrewStringParser($this->date);
        }

        if (preg_match('/[a-zA-Z]/', $this->date)) {
            return new EnglishMonthParser($this->date);
        }

        return new DefaultParser($this->date);
    }

    protected function applyFormat(array $gregorianDate)
    {
        $class = "Domanage\\Formats\\GregorianDate\\{$this->format}";

        return (new $class($gregorianDate))->format();
    }
}