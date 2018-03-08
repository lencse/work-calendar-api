<?php

namespace Test\Unit\Calendar;

use Lencse\Date\DateHelper;
use Lencse\WorkCalendar\Calendar\Day\Day;
use Test\Unit\Calendar\Mock\MockDayTypeRepository;

class CalendarIntervalTest extends CalendarBaseTest
{

    public function testGetWorkingDay(): void
    {
        $days = $this->calendar->getInterval(DateHelper::dateTime('2018-03-13'), DateHelper::dateTime('2018-03-15'));
        $expected = [
            new Day(
                DateHelper::dateTime('2018-03-13'),
                $this->dayTypeRepo->get(MockDayTypeRepository::WORKING_DAY)
            ),
            new Day(
                DateHelper::dateTime('2018-03-14'),
                $this->dayTypeRepo->get(MockDayTypeRepository::WORKING_DAY)
            ),
            new Day(
                DateHelper::dateTime('2018-03-15'),
                $this->dayTypeRepo->get(MockDayTypeRepository::NON_WORKING_DAY),
                'Description'
            ),
        ];
        $this->assertEquals($expected, $days);
    }
}
