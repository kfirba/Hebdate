<?php

namespace Kfirba\Parsers\JewishDate;

use Kfirba\Parsers\Parser;
use Kfirba\Support\HebrewNumerology;

class HebrewStringParser extends Parser
{
    /**
     * Lookup table for hebrew days.
     *
     * @var array
     */
    const dayLookup = [
        '' => 0,
        'א' => 1,
        'ב' => 2,
        'ג' => 3,
        'ד' => 4,
        'ה' => 5,
        'ו' => 6,
        'ז' => 7,
        'ח' => 8,
        'ט' => 9,
        'י' => 10,
        'יא' => 11,
        'יב' => 12,
        'יג' => 13,
        'יד' => 14,
        'טו' => 15,
        'טז' => 16,
        'יז' => 17,
        'יח' => 18,
        'יט' => 19,
        'כ' => 20,
        'כא' => 21,
        'כב' => 22,
        'כג' => 23,
        'כד' => 24,
        'כה' => 25,
        'כו' => 26,
        'כז' => 27,
        'כח' => 28,
        'כט' => 29,
        'ל' => 30,
    ];

    /**
     * Lookup table for hebrew months.
     *
     * @var array
     */
    const monthLookup = [
        '' => 0,
        'תשרי' => 1,
        'חשון' => 2,
        'כסלו' => 3,
        'טבת' => 4,
        'שבט' => 5,
        'אדר א' => 6,
        'אדר' => 7,
        'אדר ב' => 7,
        'ניסן' => 8,
        'אייר' => 9,
        'סיון' => 10,
        'תמוז' => 11,
        'אב' => 12,
        'אלול' => 13,
    ];

    /**
     * The HebrewNumerology object.
     *
     * @var HebrewNumerology
     */
    protected $numerology;

    /**
     * HebrewStringParser constructor.
     *
     * @param $date
     */
    public function __construct($date)
    {
        $this->date = $date;
        $this->numerology = new HebrewNumerology;
    }

    /**
     * Parse the request.
     *
     * @return mixed
     */
    public function parse()
    {
        return $this->sanitize()->swap();
    }

    /**
     * Swap the word representation with numeric's.
     *
     * @return $this
     */
    protected function swap()
    {
        $this->date[0] = self::dayLookup[$this->date[0]];
        $this->date[1] = self::monthLookup[$this->date[1]];

        $year = $this->numerology->sum($this->date[2], true);
        $this->date[2] = $year < 5000 ? 5000 + $year : $year;

        return $this->date;
    }

    /**
     * Sanitizes the date and remove all unnecessary characters.
     *
     * @return $this
     */
    protected function sanitize()
    {
        $this->date = array_map(function ($segment) {
            return preg_replace('[״|"|׳|\']', '', $segment);
        }, explode(' ', $this->date));

        return $this;
    }
}
