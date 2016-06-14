<?php

namespace Domanage;

use DateTime;
use Carbon\Carbon;
use Domanage\Parsers\GregorianDate\CarbonParser;
use Domanage\Parsers\GregorianDate\StringParser;
use Domanage\Parsers\GregorianDate\DateTimeParser;

/**
 * Class GregorianDate
 *
 * @package Domanage
 */
class GregorianDate extends Date
{
    /**
     * The default numeric format.
     *
     * @var string
     */
    const NUMERIC = 'Numeric';

    /**
     * Formats for english month date.
     *
     * @var string
     */
    const ENGLISH_MONTH = 'EnglishMonth';

    /**
     * Formats for full hebrew date.
     *
     * @var string
     */
    const HEBREW_FULL = 'HebrewFull';

    /**
     * Formats for presentation hebrew date.
     *
     * @var string
     */
    const PRESENTABLE_HEBREW_DATE = 'PresentableHebrewDate';

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
     * Parse the Date object and return a result based on format.
     *
     * @param string $delimiter
     * @return string
     */
    public function parse($delimiter = " ")
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
        $gregorianDate = $this->getParser()->handle();
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
        $class = "Domanage\\Formats\\JewishDate\\{$this->format}";

        return (new $class($jewishDate))->handle();
    }
}