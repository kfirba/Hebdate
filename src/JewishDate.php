<?php

namespace Domanage;

use Domanage\Parsers\JewishDate\DefaultParser;
use Domanage\Parsers\JewishDate\HebrewStringParser;
use Domanage\Parsers\JewishDate\EnglishMonthParser;

/**
 * Class JewishDate
 *
 * @package Domanage
 */
class JewishDate extends Date
{
    /**
     * The default numeric format.
     *
     * @var string
     */
    const NUMERIC = 'Numeric';

    /**
     * Carbon object format.
     *
     * @var string
     */
    const CARBON = 'Carbon';

    /**
     * DateTime object format.
     *
     * @var string
     */
    const DATETIME = 'DateTime';

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
    public function parse($delimiter = '/')
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
        $numericDate = $this->getParser()->handle();
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
        $class = "Domanage\\Formats\\GregorianDate\\{$this->format}";

        return (new $class($gregorianDate))->format();
    }
}