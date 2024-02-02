<?php

declare(strict_types=1);

namespace Apricity\DateTime;

class Date
{
    private int $day;
    private int $month;
    private int $year;

    public function __construct(string $dateString)
    {
        [$year, $month, $day] = explode('-', $dateString);

        if (!checkdate((int)$month, (int)$day, (int)$year)) {
            throw new \InvalidArgumentException("Invalid date: {$dateString}");
        }

        $this->year = (int) $year;
        $this->month = (int) $month;
        $this->day = (int) $day;
    }

    public function getYear(): Year
    {
        return new Year($this->year);
    }

    public function getMonth(): Month
    {
        return new Month(sprintf('%04d-%02d', $this->year, $this->month));
    }

    public function getDayAsNumber(): int
    {
        return $this->day;
    }

    public function __toString(): string
    {
        return sprintf('%04d-%02d-%02d', $this->year, $this->month, $this->day);
    }
}
