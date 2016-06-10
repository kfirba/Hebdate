<?php

namespace Domanage\Parsers\JewishDate;

use Domanage\Parsers\Parser;
use Domanage\Support\HebrewNumerology;

/**
 * Class HebrewFull
 *
 * @package Domanage\Parsers\JewishDate
 */
class HebrewFull extends Parser
{
    /**
     * Lookup table for hebrew days.
     *
     * @var array
     */
    const dayLookup = [
        '',
        'א',
        'ב',
        'ג',
        'ד',
        'ה',
        'ו',
        'ז',
        'ח',
        'ט',
        'י',
        'יא',
        'יב',
        'יג',
        'יד',
        'טו',
        'טז',
        'יז',
        'יח',
        'יט',
        'כ',
        'כא',
        'כב',
        'כג',
        'כד',
        'כה',
        'כו',
        'כז',
        'כח',
        'כט',
        'ל'
    ];

    /**
     * Lookup table for hebrew months.
     *
     * @var array
     */
    const monthLookup = [
        '',
        'תשרי',
        'חשון',
        'כסלו',
        'טבת',
        'שבט',
        'אדר א',
        ['אדר', 'אדר ב'],
        'ניסן',
        'אייר',
        'סיון',
        'תמוז',
        'אב',
        'אלול'
    ];

    /**
     * The HebrewNumerology instance.
     *
     * @var HebrewNumerology
     */
    protected $numerology;

    /**
     * HebrewFull constructor.
     *
     * @param array $date
     */
    public function __construct(array $date)
    {
        $this->date = $date;
        $this->numerology = new HebrewNumerology;
    }

    /**
     * Handle the parse request.
     *
     * @return array
     */
    public function handle()
    {
        $day = self::dayLookup[$this->date[1]];
        $month = self::monthLookup[$this->date[0]];

        if (is_array($month)) {
            $month = isJewishLeapYear($this->date[2]) ? $month[1] : $month[0];
        }

        $year = $this->numerology->toHebrewYear($this->date[2]);

        return [$day, $month, $year];
    }
}