<?php

use Apricity\DateTime\Year;
use PHPUnit\Framework\TestCase;

class YearTest extends TestCase
{
    public function testLeapYear()
    {
        $leapYear = new Year(2020);
        $this->assertTrue($leapYear->isLeapYear());

        $nonLeapYear = new Year(2021);
        $this->assertFalse($nonLeapYear->isLeapYear());
    }

    public function testYearEquals()
    {
        $year1 = new Year(2024);
        $year2 = new Year(2024);
        $year3 = new Year(2023);

        // Test equal years
        $this->assertTrue($year1->equals($year2), 'Equal years should return true');

        // Test non-equal years
        $this->assertFalse($year1->equals($year3), 'Non-equal years should return false');
    }

    public function testGetFirstMonth()
    {
        $year = new Year(2024);
        $firstMonth = $year->getFirstMonth();
        $this->assertEquals('2024-01', (string) $firstMonth);
    }

    public function testGetLastMonth()
    {
        $year = new Year(2024);
        $lastMonth = $year->getLastMonth();
        $this->assertEquals('2024-12', (string) $lastMonth);
    }

    public function testGetNthMonthValid()
    {
        $year = new Year(2024);
        $nthMonth = $year->getNthMonth(6);
        $this->assertEquals('2024-06', (string) $nthMonth);
    }

    public function testGetNthMonthInvalid()
    {
        $this->expectException(InvalidArgumentException::class);

        $year = new Year(2024);
        $year->getNthMonth(13);
    }

    public function testAddYears()
    {
        $year = new Year(2024);
        $newYear = $year->addYears(1);
        $this->assertEquals(2025, $newYear->asNumber());
    }

    public function testSubtractYears()
    {
        $year = new Year(2024);
        $newYear = $year->subtractYears(1);
        $this->assertEquals(2023, $newYear->asNumber());
    }
}
