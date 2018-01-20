<?php

namespace Test\Unit\Calendar;

use Lencse\WorkCalendar\Calendar\DayType;
use Lencse\WorkCalendar\Calendar\Exception\WrongDayTypeException;
use PHPUnit\Framework\TestCase;

class DayTypeTest extends TestCase
{

    public function testRestDay()
    {
        $types = [
            DayType::NON_WORKING_DAY => true,
            DayType::RELOCATED_REST_DAY => true,
            DayType::RELOCATED_WORKING_DAY => false,
            DayType::WORKING_DAY => false,
            DayType::WEEKEND => true
        ];
        foreach ($types as $type => $restDay) {
            $dayType = DayType::get($type);
            $this->assertEquals($type, $dayType->getKey());
            $this->assertEquals($restDay, $dayType->isRestDay());
        }
    }

    public function testArgument()
    {
        $this->expectException(WrongDayTypeException::class);
        DayType::get('invalid');
    }

    public function testName()
    {
        $names = [
            DayType::NON_WORKING_DAY => 'Munkaszüneti nap',
            DayType::RELOCATED_REST_DAY => 'Áthelyezett pihenőnap',
            DayType::RELOCATED_WORKING_DAY => 'Áthelyezett munkanap',
            DayType::WORKING_DAY => 'Munkanap',
            DayType::WEEKEND => 'Heti pihenőnap',
        ];
        foreach ($names as $type => $name) {
            $dayType = DayType::get($type);
            $this->assertEquals($name, $dayType->getName());
        }
    }

    public function testRegular()
    {
        $types = [
            DayType::NON_WORKING_DAY => false,
            DayType::RELOCATED_REST_DAY => false,
            DayType::RELOCATED_WORKING_DAY => false,
            DayType::WORKING_DAY => true,
            DayType::WEEKEND => true
        ];
        foreach ($types as $type => $regular) {
            $dayType = DayType::get($type);
            $this->assertEquals($type, $dayType->getKey());
            $this->assertEquals($regular, $dayType->isRegular());
        }
    }
}
