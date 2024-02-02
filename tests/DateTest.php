<?php

declare(strict_types=1);

namespace Apricity\DateTime\Tests;

use Apricity\DateTime\Date;
use Apricity\DateTime\Month;
use Apricity\DateTime\Year;
use PHPUnit\Framework\TestCase;

class DateTest extends TestCase
{
    public function testDateConstructionAndComponents()
    {
        $dateString = '2024-02-29';
        $date = new Date($dateString);

        // Test year component
        $this->assertInstanceOf(Year::class, $date->getYear());
        $this->assertEquals(2024, $date->getYear()->asNumber());

        // Test month component
        $this->assertInstanceOf(Month::class, $date->getMonth());
        $this->assertEquals(2, $date->getMonth()->getMonthAsNumber());

        // Test day component
        $this->assertEquals(29, $date->getDayAsNumber());
    }

    public function testToString()
    {
        $dateString = '2023-03-15';
        $date = new Date($dateString);
        $this->assertEquals($dateString, (string) $date);
    }

    public function testInvalidDate()
    {
        $this->expectException(InvalidArgumentException::class);
        new Date('2023-02-29'); // Invalid non-leap year date
    }
}
