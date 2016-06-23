<?php

namespace Kfirba;

use Kfirba\Parsers\JewishDate\DefaultParser;
use Kfirba\Parsers\JewishDate\HebrewStringParser;
use Kfirba\Parsers\JewishDate\EnglishMonthParser;

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
     * Instantiate a GregorianDate object.
     *
     * @param $date
     * @return GregorianDate
     */
    public static function fromGregorian($date)
    {
        return new GregorianDate($date);
    }

    /**
     * Parse the Date object and return a result based on format.
     *
     * @param string $delimiter
     * @return string
     */
    public function convert($delimiter = '/')
    {
        $julianDate = $this->toJulianDate();

        $gregorianDate = $this->applyFormat(
            explode('/', jdtogregorian($julianDate))
        );

        return is_array($gregorianDate) ? implode($delimiter, $gregorianDate) : $gregorianDate;
    }

    /**
     * Get the julian date representation for the current date.
     *
     * @return int
     */
    protected function toJulianDate()
    {
        $numericDate = $this->getParser()->parse();
        list($day, $month, $year) = $numericDate;

        return jewishtojd($month, $day, $year);
    }

    /**
     * Get the appropriate parser for the date.
     *
     * @return DefaultParser|EnglishMonthParser|HebrewStringParser
     */
    public function getParser()
    {
        // if the date is an array, we will implode it with
        // a space to make it comply with the reset of
        // the formats, so we can easily parse it.
        if (is_array($this->date)) {
            $this->date = implode(' ', $this->date);

            return $this->getParser();
        }

        if (preg_match('/[א-ת]/', $this->date)) {
            return new HebrewStringParser($this->date);
        }

        if (preg_match('/[a-zA-Z]/', $this->date)) {
            return new EnglishMonthParser($this->date);
        }

        return new DefaultParser($this->date);
    }

    /**
     * Apply a format.
     *
     * @param array $gregorianDate
     * @return mixed
     */
    protected function applyFormat(array $gregorianDate)
    {
        $class = "Kfirba\\Formats\\GregorianDate\\{$this->format}";

        return (new $class($gregorianDate))->format();
    }
}