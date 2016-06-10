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
     * Format for presentation hebrew date.
     *
     * @var string
     */
    const PRESENTABLE_HEBREW_DATE = 'PresentableHebrewDate';

    /**
     * Gregorian date input.
     *
     * @var string|Carbon|\DateTime
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
     * Create a new HebrewDate instance with given gregorian date.
     *
     * @param $date
     * @return static
     */
    public static function fromGregorian($date)
    {
        return new static($date);
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
        if ($this->gregorianDate instanceof Carbon) {
            return new CarbonParser($this->gregorianDate);
        }

        if ($this->gregorianDate instanceof DateTime) {
            return new DateTimeParser($this->gregorianDate);
        }

        return new StringParser($this->gregorianDate);
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
     * Convert the HebrewDate object into its string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->parse();
    }
}