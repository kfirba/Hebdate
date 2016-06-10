<?php

namespace Domanage;

use DateTime;
use Carbon\Carbon;
use Domanage\Parsers\GregorianDate\CarbonParser;
use Domanage\Parsers\GregorianDate\StringParser;
use Domanage\Parsers\GregorianDate\DateTimeParser;

/**
 * Class HebrewDate
 *
 * @package Domanage
 */
class HebrewDate
{

    /**
     * The default numeric format.
     * 
     * @var string
     */
    const NUMERIC = 'Numeric';

    /**
     * Format for english month date.
     *
     * @var string
     */
    const ENGLISH_MONTH = 'EnglishMonth';

    /**
     * Format for full hebrew date.
     *
     * @var string
     */
    const HEBREW_FULL = 'HebrewFull';

    /**
     * Parsed gregorian date input in mm/dd/yyyy format.
     *
     * @var array
     */
    protected $gregorianDate;

    /**
     * The default format for output.
     *
     * @var string
     */
    protected $format = 'Numeric';

    /**
     * HebrewDate constructor.
     *
     * @param $gregorianDate
     */
    public function __construct($gregorianDate)
    {
        $this->gregorianDate = $gregorianDate;
    }

    /**
     * Create a new HebrewDate instance with parsed date.
     *
     * @param $date
     * @return static
     */
    public static function fromGregorian($date)
    {
        $parser = static::getParser($date);

        return new static($parser->handle());
    }

    /**
     * Get the right parser for the given input.
     *
     * @param $date
     * @return CarbonParser|DateTimeParser|StringParser
     */
    protected static function getParser($date)
    {
        if ($date instanceof Carbon) {
            return new CarbonParser($date);
        }

        if ($date instanceof DateTime) {
            return new DateTimeParser($date);
        }

        return new StringParser($date);
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
     * Parse the HebrewDate object and return a result based on format.
     *
     * @param string $delimiter
     * @return string
     */
    public function parse($delimiter = " ")
    {
        list($gregorianDay, $gregorianMonth, $gregorianYear) = $this->gregorianDate;
        $julianDate = gregoriantojd($gregorianDay, $gregorianMonth, $gregorianYear);

        $jewishDate = jdtojewish($julianDate);

        $jewishDate = $this->applyFormat(explode('/', $jewishDate));

        return implode($delimiter, $jewishDate);
    }

    /**
     * Apply a format.
     *
     * @param array $jewishDate
     * @return mixed
     */
    protected function applyFormat(array $jewishDate)
    {
        $class = "Domanage\\Parsers\\JewishDate\\{$this->format}";

        return (new $class($jewishDate))->handle();
    }

    /**
     * Check whether the given year is a leap year or not.
     *
     * @param $year
     * @return bool
     */
    public static function isLeapYear($year)
    {
        return ($year % 19 == 0 || $year % 19 == 3 || $year % 19 == 6 || $year % 19 == 8 ||
            $year % 19 == 11 || $year % 19 == 14 || $year % 19 == 17);
    }

    /**
     * Convert the HebrewDate object into its string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->parse();
    }
}