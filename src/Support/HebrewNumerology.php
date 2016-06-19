<?php

namespace Kfirba\Support;

class HebrewNumerology
{
    /**
     * Lookup table for hebrew characters.
     *
     * @var array
     */
    const numerology = [
        "א" => 1,
        "ב" => 2,
        "ג" => 3,
        "ד" => 4,
        "ה" => 5,
        "ו" => 6,
        "ז" => 7,
        "ח" => 8,
        "ט" => 9,
        "י" => 10,
        "כ" => 20,
        "ל" => 30,
        "מ" => 40,
        "נ" => 50,
        "ס" => 60,
        "ע" => 70,
        "פ" => 80,
        "צ" => 90,
        "ק" => 100,
        "ר" => 200,
        "ש" => 300,
        "ת" => 400,
        "ך" => 20,
        "ם" => 40,
        "ן" => 50,
        "ף" => 80,
        "ץ" => 90
    ];

    /**
     * Get the sum of the word numerical representation.
     *
     * @param      $word
     * @param bool $hebrewYear
     * @return number
     */
    public function sum($word, $hebrewYear = false)
    {
        $this->validateHebrewCharactersOnly($word);

        $letters = utf8_str_split($word);

        $letters[0] = ($letters[0] == 'ה' && $hebrewYear) ? 5000 : $letters[0];

        return array_sum(array_map(function ($letter) {
            return is_numeric($letter) ? $letter : self::numerology[$letter];
        }, $letters));
    }

    /**
     * Validate the input to be only hebrew characters.
     *
     * @param $word
     */
    protected function validateHebrewCharactersOnly($word)
    {
        if ( ! preg_match('/[א-ת]/', $word)) {
            throw new \InvalidArgumentException('The string must be in hebrew with no spaces');
        }
    }

    /**
     * Converts given number to hebrew year text.
     *
     * @param $number
     * @return string
     */
    public function toHebrewYear($number)
    {
        $this->validateDigitsOnly($number);

        $digits = str_split($number);

        if (count($digits) === 4) {
            return $this->toFullHebrewYear($digits);
        }

        return $this->toNormalHebrewYear($digits);
    }

    /**
     * Validates that the input is digits only.
     *
     * @param $number
     */
    protected function validateDigitsOnly($number)
    {
        if ( ! ctype_digit($number)) {
            throw new \InvalidArgumentException("[$number] isn't a number.");
        }
    }

    /**
     * Adds the "ה" to the returned hebrew year text.
     *
     * @param array $digits
     * @return string
     */
    protected function toFullHebrewYear(array $digits)
    {
        // This is gonna work for the next 224 years
        // If you find yourself using this after
        // that time, oh well, you are fucked
        $output = 'ה';
        array_shift($digits);

        return $this->toNormalHebrewYear($digits, $output);
    }

    /**
     * Calculates the hebrew year text representation.
     *
     * @param array  $digits
     * @param string $output
     * @return string
     */
    protected function toNormalHebrewYear(array $digits, $output = '')
    {
        $digits = array_reverse($digits);

        $expanded = $this->expandDigits($digits);

        $mapped = $this->mapToCharacters($expanded);

        return $output . implode(array_reverse($mapped));
    }

    /**
     * Expand every digit to a full number based on its base 10 position.
     *
     * @param array $digits
     * @return mixed
     */
    protected function expandDigits(array $digits)
    {
        array_reduce($digits, function ($multiplier, $digit) use (&$expanded) {
            $expanded[] = $digit * $multiplier;

            return $multiplier * 10;
        }, 1);

        return $expanded;
    }

    /**
     * Maps the numbers to corresponding hebrew characters.
     *
     * @param array $expanded
     * @return array
     */
    protected function mapToCharacters(array $expanded)
    {
        return array_map(function ($number) {
            return $this->getCharactersForNumber($number);
        }, $expanded);
    }

    /**
     * Get the corresponding character for a given number.
     *
     * @param $number
     * @return string
     */
    protected function getCharactersForNumber($number)
    {
        if ($number <= 400) {
            return array_flip(self::numerology)[$number];
        }

        $possibilities = $this->getCharactersPossibilities();

        $characters = '';

        foreach ($possibilities as $possibility => $character) {
            if ($number >= $possibility) {
                $characters .= $character;
                $number -= $possibility;
            }
        }

        return $characters;
    }

    /**
     * Get the characters possible for numbers greater than 400.
     *
     * @return array
     */
    protected function getCharactersPossibilities()
    {
        return array_flip(
            array_reverse(array_filter(self::numerology, function ($item) {
                return $item >= 100;
            }))
        );
    }
}