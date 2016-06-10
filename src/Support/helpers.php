<?php

if ( ! function_exists('utf8_str_split')) {
    /**
     * Splits string by using multi-bytes.
     *
     * @param string $str
     * @param int    $len
     * @return array
     */
    function utf8_str_split($str = '', $len = 0)
    {
        return preg_split('/(?<=\G.{' . $len . '})/u', $str, - 1, PREG_SPLIT_NO_EMPTY);
    }
}

if ( ! function_exists('isJewishLeapYear')) {
    /**
     * Check whether the given year is a leap year or not.
     *
     * @param $year
     * @return bool
     */
    function isJewishLeapYear($year)
    {
        return ($year % 19 == 0 || $year % 19 == 3 || $year % 19 == 6 || $year % 19 == 8 ||
            $year % 19 == 11 || $year % 19 == 14 || $year % 19 == 17);
    }
}