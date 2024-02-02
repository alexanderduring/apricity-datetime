<?php

declare(strict_types=1);

namespace Apricity\DateTime;

use InvalidArgumentException;

class Year
{
    private int $year;

    public function __construct(int $year)
    {
        $this->year = $year;
    }

    public function asNumber(): int
    {
        return $this->year;
    }

    public function isLeapYear(): bool
    {
        return ($this->year % 4 === 0 && $this->year % 100 !== 0) || ($this->year % 400 === 0);
    }

    public function equals(Year $otherYear): bool
    {
        return $this->year === $otherYear->asNumber();
    }

    public function getFirstMonth(): Month
    {
        return $this->getNthMonth(1);
    }

    public function getLastMonth(): Month
    {
        return $this->getNthMonth(12);
    }

    public function getNthMonth(int $n): Month
    {
        if ($n < 1 || $n > 12) {
            throw new InvalidArgumentException("Month number must be between 1 and 12.");
        }
        return new Month(sprintf('%04d-%02d', $this->year, $n));
    }

    public function addYears(int $numberOfYears): Year
    {
        return new Year($this->year + $numberOfYears);
    }

    public function subtractYears(int $numberOfYears): Year
    {
        return new Year($this->year - $numberOfYears);
    }
}
