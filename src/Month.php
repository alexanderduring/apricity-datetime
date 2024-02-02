<?php

declare(strict_types=1);

namespace Apricity\DateTime;

class Month
{
    private int $month;
    private int $year;

    public function __construct(?string $dateString = null)
    {
        if ($dateString === null) {
            $this->month = (int) date('n');
            $this->year = (int) date('Y');
        } else {
            [$year, $month] = explode('-', $dateString);
            $this->month = (int) $month;
            $this->year = (int) $year;
        }
    }

    public function getMonthAsNumber(): int
    {
        return $this->month;
    }

    public function getYear(): Year
    {
        return new Year($this->year);
    }

    public function getNumberOfDays(): int
    {
        switch ($this->month) {
            case 4:
            case 6:
            case 9:
            case 11:
                return 30;
            case 2:
                return ($this->year % 4 === 0 && $this->year % 100 !== 0) || ($this->year % 400 === 0) ? 29 : 28;
            default:
                return 31;
        }
    }

    public function equals(Month $otherMonth): bool
    {
        return $this->month === $otherMonth->getMonthAsNumber() && $this->year === $otherMonth->getYear()->getYear();
    }

    public function isBefore(Month $otherMonth): bool
    {
        if ($this->year < $otherMonth->getYear()->getYear()) {
            return true;
        } elseif ($this->year === $otherMonth->getYear()->getYear()) {
            return $this->month < $otherMonth->getMonthAsNumber();
        }
        return false;
    }

    public function isAfter(Month $otherMonth): bool
    {
        if ($this->year > $otherMonth->getYear()->getYear()) {
            return true;
        } elseif ($this->year === $otherMonth->getYear()->getYear()) {
            return $this->month > $otherMonth->getMonthAsNumber();
        }
        return false;
    }

    public function isSameYear(Month $otherMonth): bool
    {
        return $this->getYear()->equals($otherMonth->getYear());
    }

    public function addMonths(int $numberOfMonths): Month
    {
        $newMonth = $this->month + $numberOfMonths;
        $newYear = $this->year + intdiv($newMonth - 1, 12);
        $newMonth = (($newMonth - 1) % 12) + 1;
        return new self(sprintf('%04d-%02d', $newYear, $newMonth));
    }

    public function subMonths(int $numberOfMonths): Month
    {
        $newMonth = $this->month - $numberOfMonths;
        while ($newMonth <= 0) {
            $newMonth += 12;
            $this->year--;
        }
        $newYear = $this->year;
        return new self(sprintf('%04d-%02d', $newYear, $newMonth));
    }

    public function __toString(): string
    {
        return sprintf('%04d-%02d', $this->year, $this->month);
    }
}
