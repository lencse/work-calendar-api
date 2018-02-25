<?php

namespace Test\Unit\Calendar;

use Lencse\Date\DateHelper;
use Lencse\WorkCalendar\Calendar\Day\DayImp;
use Test\Unit\Calendar\Mock\MockDayTypeRepository;

class CalendarSpecialDaysTest extends CalendarBaseTest
{

    public function testGetAllSpecialDays()
    {
        $days = $this->calendar->getAllSpecialDays();
        $expected = [
            new DayImp(
                DateHelper::dateTime('2015-03-15'),
                $this->dayTypeRepo->get(MockDayTypeRepository::NON_WORKING_DAY),
                'description'
            ),
            new DayImp(
                DateHelper::dateTime('2015-10-23'),
                $this->dayTypeRepo->get(MockDayTypeRepository::NON_WORKING_DAY),
                'description'
            ),
            new DayImp(
                DateHelper::dateTime('2018-03-15'),
                $this->dayTypeRepo->get(MockDayTypeRepository::NON_WORKING_DAY),
                'description'
            ),
        ];
        $this->assertEquals($expected, $days);
    }

    public function testGetSpecialDaysForYear()
    {
        $days = $this->calendar->getSpecialDaysForYear(2015);
        $expected = [
            new DayImp(
                DateHelper::dateTime('2015-03-15'),
                $this->dayTypeRepo->get(MockDayTypeRepository::NON_WORKING_DAY),
                'description'
            ),
            new DayImp(
                DateHelper::dateTime('2015-10-23'),
                $this->dayTypeRepo->get(MockDayTypeRepository::NON_WORKING_DAY),
                'description'
            ),
        ];
        $this->assertEquals($expected, $days);
    }
}
