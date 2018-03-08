<?php

namespace Test\Unit\Calendar;

use Lencse\Date\DateHelper;
use Lencse\WorkCalendar\Calendar\Day\Day;
use Test\Unit\Calendar\Mock\MockDayTypeRepository;

class CalendarSpecialDaysTest extends CalendarBaseTest
{

    public function testGetAllSpecialDays(): void
    {
        $days = $this->dayRepo->getAll();
        $expected = [
            new Day(
                DateHelper::dateTime('2015-03-15'),
                $this->dayTypeRepo->get(MockDayTypeRepository::NON_WORKING_DAY),
                'Description'
            ),
            new Day(
                DateHelper::dateTime('2015-10-23'),
                $this->dayTypeRepo->get(MockDayTypeRepository::NON_WORKING_DAY),
                'Description'
            ),
            new Day(
                DateHelper::dateTime('2018-03-15'),
                $this->dayTypeRepo->get(MockDayTypeRepository::NON_WORKING_DAY),
                'Description'
            ),
        ];
        $this->assertEquals($expected, $days);
    }

    public function testGetSpecialDaysForYear(): void
    {
        $days = $this->dayRepo->getForYear(2015);
        $expected = [
            new Day(
                DateHelper::dateTime('2015-03-15'),
                $this->dayTypeRepo->get(MockDayTypeRepository::NON_WORKING_DAY),
                'Description'
            ),
            new Day(
                DateHelper::dateTime('2015-10-23'),
                $this->dayTypeRepo->get(MockDayTypeRepository::NON_WORKING_DAY),
                'Description'
            ),
        ];
        $this->assertEquals($expected, $days);
    }
}
