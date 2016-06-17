<?php

namespace Kfirba\Parsers\GregorianDate;

use Kfirba\Parsers\Parser;
use InvalidArgumentException;

/**
 * Class StringParser
 *
 * @package Kfirba\Parsers\GregorianDate
 */
class StringParser extends Parser
{
    /**
     * Parse the request.
     *
     * @return array
     */
    public function parse()
    {
        $this->validate();

        $delimiter = $this->getDelimiter();
        list($day, $month, $year) = explode($delimiter, $this->date);

        // we conform to the jd functions format
        return [$month, $day, $year];
    }

    /**
     * Validates the input's format.
     *
     * @throws InvalidArgumentException
     */
    protected function validate()
    {
        $regex = '/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/';

        if ( ! preg_match($regex, $this->date)) {
            throw new InvalidArgumentException("The date should be in appropriate date format dd/mm/yyyy");
        }
    }

    /**
     * Get the used delimiter.
     *
     * @return string
     */
    protected function getDelimiter()
    {
        if (strpos($this->date, '/')) {
            return '/';
        }

        if (strpos($this->date, '-')) {
            return '-';
        }

        return '.';
    }
}