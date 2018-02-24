<?php

namespace Test\Unit\Calendar;

use Lencse\Date\DateHelper;
use Lencse\WorkCalendar\Calendar\Day\DayImp;
use Lencse\WorkCalendar\Calendar\Repository\HuDayTypeRepository;

class CalendarIntervalTest extends CalendarBaseTest
{

    public function testGetWorkingDay()
    {
        $days = $this->calendar->getInterval(DateHelper::dateTime('2018-03-13'), DateHelper::dateTime('2018-03-15'));
        $expected = [
            new DayImp(
                DateHelper::dateTime('2018-03-13'),
                $this->dayTypeRepo->get(HuDayTypeRepository::WORKING_DAY)
            ),
            new DayImp(
                DateHelper::dateTime('2018-03-14'),
                $this->dayTypeRepo->get(HuDayTypeRepository::WORKING_DAY)
            ),
            new DayImp(
                DateHelper::dateTime('2018-03-15'),
                $this->dayTypeRepo->get(HuDayTypeRepository::NON_WORKING_DAY),
                'description'
            ),
        ];
        $this->assertEquals($expected, $days);
    }
}
