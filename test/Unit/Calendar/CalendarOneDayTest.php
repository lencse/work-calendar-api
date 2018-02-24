<?php

namespace Test\Unit\Calendar;

use Lencse\Date\DateHelper;
use Lencse\WorkCalendar\Calendar\Repository\HuDayTypeRepository;

class CalendarOneDayTest extends CalendarBaseTest
{

    public function testGetWorkingDay()
    {
        $day = $this->calendar->getDay(DateHelper::dateTime('2018-02-23'));
        $this->assertEquals(DateHelper::dateTime('2018-02-23'), $day->getDate());
        $this->assertEquals($this->dayTypeRepo->get(HuDayTypeRepository::WORKING_DAY), $day->getType());
        $this->assertEquals('', $day->getDescription());
    }

    public function testGetWeekend()
    {
        $day = $this->calendar->getDay(DateHelper::dateTime('2018-02-24'));
        $this->assertEquals(DateHelper::dateTime('2018-02-24'), $day->getDate());
        $this->assertEquals($this->dayTypeRepo->get(HuDayTypeRepository::WEEKEND), $day->getType());
        $this->assertEquals('', $day->getDescription());
    }

    public function testGetNonWorkingDay()
    {
        $day = $this->calendar->getDay(DateHelper::dateTime('2018-03-15'));
        $this->assertEquals(DateHelper::dateTime('2018-03-15'), $day->getDate());
        $this->assertEquals($this->dayTypeRepo->get(HuDayTypeRepository::NON_WORKING_DAY), $day->getType());
        $this->assertEquals('description', $day->getDescription());
    }
}
