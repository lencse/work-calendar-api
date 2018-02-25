<?php

namespace Test\Unit\Calendar;

use Lencse\Date\DateHelper;
use Lencse\WorkCalendar\Calendar\Day\DayImp;
use Test\Unit\Calendar\Mock\MockDayTypeRepository;

class CalendarDayTypesTest extends CalendarBaseTest
{

    public function testGetAllTypes()
    {
        $types = $this->calendar->getAllTypes();
        $this->assertCount(3, $types);
    }
}
