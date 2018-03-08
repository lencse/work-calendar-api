<?php

namespace Test\Unit\Calendar;

use Lencse\Date\DateHelper;
use Lencse\WorkCalendar\Calendar\Day\Day;
use Test\Unit\Calendar\Mock\MockDayTypeRepository;

class CalendarYearTest extends CalendarBaseTest
{

    public function testGetNonLeapYear(): void
    {
        $days = $this->calendar->getYear(2018);
        $this->assertCount(365, $days);
        $this->assertTrue(
            in_array(
                new Day(
                    DateHelper::dateTime('2018-03-15'),
                    $this->dayTypeRepo->get(MockDayTypeRepository::NON_WORKING_DAY),
                    'Description'
                ),
                $days,
                false
            )
        );
    }

    public function testGetLeapYear(): void
    {
        $days = $this->calendar->getYear(2016);
        $this->assertCount(366, $days);
    }
}
