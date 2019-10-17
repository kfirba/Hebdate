<?php

namespace Kfirba\Formats;

abstract class Format
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
