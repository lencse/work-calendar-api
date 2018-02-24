<?php

namespace Test\Unit\Calendar;

use Lencse\Date\DateHelper;
use Lencse\WorkCalendar\Calendar\Day\DayImp;
use Lencse\WorkCalendar\Calendar\Repository\HuDayTypeRepository;

class CalendarYearTest extends CalendarBaseTest
{

    public function testGetNonLeapYear()
    {
        $days = $this->calendar->getYear(2018);
        $this->assertCount(365, $days);
        $this->assertTrue(
            in_array(
                new DayImp(
                    DateHelper::dateTime('2018-03-15'),
                    $this->dayTypeRepo->get(HuDayTypeRepository::NON_WORKING_DAY),
                    'description'
                ),
                $days,
                false
            )
        );
    }

    public function testGetLeapYear()
    {
        $days = $this->calendar->getYear(2016);
        $this->assertCount(366, $days);
    }
}
