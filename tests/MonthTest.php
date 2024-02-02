<?php

use Apricity\DateTime\Month;
use Apricity\DateTime\Year;
use PHPUnit\Framework\TestCase;

class MonthTest extends TestCase
{
    public function testConstructorAndGetters()
    {
        $month = new Month('2024-02');
        $this->assertEquals(2, $month->getMonthAsNumber());
        $this->assertEquals(2024, $month->getYear()->asNumber());
    }

    public function testGetNumberOfDays()
    {
        // Non-leap year
        $year2023 = new Year(2023);
        $this->assertEquals(31, $year2023->getNthMonth(1)->getNumberOfDays()); // January
        $this->assertEquals(28, $year2023->getNthMonth(2)->getNumberOfDays()); // February
        $this->assertEquals(31, $year2023->getNthMonth(3)->getNumberOfDays()); // March
        $this->assertEquals(30, $year2023->getNthMonth(4)->getNumberOfDays()); // April
        $this->assertEquals(31, $year2023->getNthMonth(5)->getNumberOfDays()); // May
        $this->assertEquals(30, $year2023->getNthMonth(6)->getNumberOfDays()); // June
        $this->assertEquals(31, $year2023->getNthMonth(7)->getNumberOfDays()); // July
        $this->assertEquals(31, $year2023->getNthMonth(8)->getNumberOfDays()); // August
        $this->assertEquals(30, $year2023->getNthMonth(9)->getNumberOfDays()); // September
        $this->assertEquals(31, $year2023->getNthMonth(10)->getNumberOfDays()); // October
        $this->assertEquals(30, $year2023->getNthMonth(11)->getNumberOfDays()); // November
        $this->assertEquals(31, $year2023->getNthMonth(12)->getNumberOfDays()); // December

        // Leap year
        $year2024 = new Year(2024);
        $this->assertEquals(29, $year2024->getNthMonth(2)->getNumberOfDays()); // February in a leap year
    }

    public function testEquals()
    {
        $month1 = new Month('2024-02');
        $month2 = new Month('2024-02');
        $month3 = new Month('2023-02');

        $this->assertTrue($month1->equals($month2));
        $this->assertFalse($month1->equals($month3));
    }

    public function testIsBeforeAndIsAfter()
    {
        $january2024 = new Month('2024-01');
        $february2024 = new Month('2024-02');

        $this->assertTrue($january2024->isBefore($february2024));
        $this->assertFalse($january2024->isAfter($february2024));
        $this->assertTrue($february2024->isAfter($january2024));
        $this->assertFalse($february2024->isBefore($january2024));
    }

    public function testAddAndSubtractMonths()
    {
        $january2024 = new Month('2024-01');
        $march2024 = $january2024->addMonths(2);
        $this->assertEquals('2024-03', (string) $march2024);

        $december2023 = $january2024->subMonths(1);
        $this->assertEquals('2023-12', (string) $december2023);
    }

    public function testIsSameYear()
    {
        $month1 = new Month('2024-01');
        $month2 = new Month('2024-12');
        $month3 = new Month('2023-01');

        // Test months within the same year
        $this->assertTrue($month1->isSameYear($month2), 'Months within the same year should return true');

        // Test months in different years
        $this->assertFalse($month1->isSameYear($month3), 'Months in different years should return false');
    }

    public function testToString()
    {
        $month = new Month('2024-02');
        $this->assertEquals('2024-02', (string) $month);
    }
}
