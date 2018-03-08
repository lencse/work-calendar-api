<?php

namespace Test\Unit\Calendar;

use Lencse\Date\DateHelper;
use Test\Unit\Calendar\Mock\MockDayTypeRepository;

class CalendarOneDayTest extends CalendarBaseTest
{

    public function testGetWorkingDay(): void
    {
        $day = $this->calendar->getDay(DateHelper::dateTime('2018-02-23'));
        $this->assertEquals(DateHelper::dateTime('2018-02-23'), $day->getDate());
        $this->assertEquals($this->dayTypeRepo->get(MockDayTypeRepository::WORKING_DAY), $day->getType());
        $this->assertEquals('', $day->getDescription());
    }

    public function testGetWeekend(): void
    {
        $day = $this->calendar->getDay(DateHelper::dateTime('2018-02-24'));
        $this->assertEquals(DateHelper::dateTime('2018-02-24'), $day->getDate());
        $this->assertEquals($this->dayTypeRepo->get(MockDayTypeRepository::WEEKEND), $day->getType());
        $this->assertEquals('', $day->getDescription());
    }

    public function testGetNonWorkingDay(): void
    {
        $day = $this->calendar->getDay(DateHelper::dateTime('2018-03-15'));
        $this->assertEquals(DateHelper::dateTime('2018-03-15'), $day->getDate());
        $this->assertEquals($this->dayTypeRepo->get(MockDayTypeRepository::NON_WORKING_DAY), $day->getType());
        $this->assertEquals('Description', $day->getDescription());
    }
}
