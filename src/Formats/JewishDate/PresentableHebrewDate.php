<?php

namespace Domanage\Formats\JewishDate;

use Domanage\Parsers\Parser;

/**
 * Class PresentableHebrewDate
 *
 * @package Domanage\Parsers\JewishDate
 */
class PresentableHebrewDate extends Parser
{
    /**
     * Handle the parse request.
     *
     * @return mixed
     */
    public function handle()
    {
        // we will use the already existing HebrewFull parser
        // to give is a good head start with this compilation
        $hebrewDate = (new HebrewFull($this->date))->handle();

        $day = $hebrewDate[0]."׳";
        $month = $this->decorateMonth($hebrewDate[1]);
        $year = $this->decorateYear($hebrewDate[2]);

        return [$day, $month, $year];
    }

    /**
     * Decorates the given month.
     *
     * @param $month
     * @return string
     */
    protected function decorateMonth($month)
    {
        if (count(explode(' ', $month)) > 1) {
            return $month."׳";
        }

        return $month;
    }

    /**
     * Decorates the given year.
     *
     * @param $year
     * @return string
     */
    protected function decorateYear($year)
    {
        $year = utf8_str_split($year);
        $modifier = '״'.array_pop($year);
        array_push($year, $modifier);

        return implode($year);
    }
}