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
