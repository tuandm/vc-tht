<?php
if (!function_exists('lunar_date')) {

    /**
     * A simple function to calculate the Lunar Standard Time
     *
     * Gabor Heja (gheja) <lunar dot date at stdio dot hu>, 2011, v1
     *
     * This code is free, redistribute and/or modify under the terms of
     * GPL v3 or later. See http://www.gnu.org/licenses/gpl.html
     *
     * Lunar epoch is 1969-07-21 02:56:15 UTC (-14159025 in Unix Time)
     *
     * 1 Lunar second is 0.9843529666671 second on Earth
     * 1 Lunar minute is 60 Lunar seconds
     * 1 Lunar hour is 60 Lunar minutes
     * 1 Lunar cycle is 24 Lunar hours
     * 1 Lunar day is 30 Lunar cycles
     * 1 Lunar year is 12 Lunar days
     *
     * The days are named after the twelve men who walked on the Moon.
     *
     * For more info see http://lunarclock.org/
     * @param string $formatString
     * @param int|null $time
     * @return string
     * @throws Exception
     * @see https://dev.kakaopor.hu/stuffs/lunar_date.php.txt
     */
    function lunar_date(string $formatString, int $time = null): string
    {
        if ($time === null) {
            $time = time();
        }

        $unixSecondsSinceLunarEpoch = $time + 14159025;
        if ($unixSecondsSinceLunarEpoch < 0) {
            throw new \InvalidArgumentException('Invalid date', 422);
        }
        $lunarTime = (int) ($unixSecondsSinceLunarEpoch / 0.984352966667);

        $years = floor($lunarTime / (31104000)) + 1;
        $days = floor($lunarTime % (31104000) / (30 * 24 * 60 * 60)) + 1;
        $cycles = floor($lunarTime % (30 * 24 * 60 * 60) / (24 * 60 * 60)) + 1;
        $hours = floor($lunarTime % (24 * 60 * 60) / 3600);
        $minutes = floor($lunarTime % (60 * 60) / 60);
        $seconds = floor($lunarTime % (60));

        $lunarDayNames = [
            'Armstrong',
            'Aldrin',
            'Conrad',
            'Bean',
            'Shepard',
            'Mitchell',
            'Scott',
            'Irwin',
            'Young',
            'Duke',
            'Cernan',
            'Schmitt',
        ];

        $array = [
            's' => $lunarTime,
            'y' => $years,
            'j' => $days,
            'c' => $cycles,
            'G' => $hours,
            'n' => $minutes,
            'Y' => sprintf('%02d', $years),
            'd' => sprintf('%02d', $days),
            'C' => sprintf('%02d', $cycles),
            'H' => sprintf('%02d', $hours),
            'i' => sprintf('%02d', $minutes),
            'S' => sprintf('%02d', $seconds),
            'z' => $days * 30 + $cycles,
            'g' => $hours % 12 + 1,
            'h' => sprintf('%02d', $hours % 12 + 1),
            'T' => 'LST',
            'D' => $lunarDayNames[$days - 1],
        ];

        return str_replace(array_keys($array), array_values($array), $formatString);
    }
}
