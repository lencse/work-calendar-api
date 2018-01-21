<?php

namespace Test\Unit\Calendar;

use Lencse\Date\DateHelper;
use Lencse\WorkCalendar\Calendar\Day;
use Lencse\WorkCalendar\Calendar\DayType;
use PHPUnit\Framework\TestCase;

class DayTest extends TestCase
{

    public function testDayCreation()
    {
        $day = new Day(
            DateHelper::dateTime('2018-03-15'),
            DayType::get(DayType::NON_WORKING_DAY),
            'Az 1848-as forradalom ünnepe'
        );
        $this->assertEquals(\DateTime::createFromFormat('Y-m-d', '2018-03-15'), $day->getDate());
        $this->assertEquals('Az 1848-as forradalom ünnepe', $day->getDescription());
        $this->assertEquals(DayType::get(DayType::NON_WORKING_DAY), $day->getType());
    }

    public function testDayCreationWithEmptyDescription()
    {
        $day = new Day(
            DateHelper::dateTime('2017-03-18'),
            DayType::get(DayType::RELOCATED_WORKING_DAY)
        );
        $this->assertEquals(\DateTime::createFromFormat('Y-m-d', '2017-03-18'), $day->getDate());
        $this->assertEquals('', $day->getDescription());
    }
}
