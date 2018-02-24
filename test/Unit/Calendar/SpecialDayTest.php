<?php

namespace Test\Unit\Calendar;

use Lencse\Date\DateHelper;
use Lencse\WorkCalendar\Calendar\DayType;
use Lencse\WorkCalendar\Calendar\SpecialDay;
use PHPUnit\Framework\TestCase;

class SpecialDayTest extends TestCase
{

    public function testDayCreation()
    {
        $day = new SpecialDay(
            DateHelper::dateTime('2017-03-15'),
            DayType::get(DayType::NON_WORKING_DAY),
            'Az 1848-as forradalom ünnepe'
        );
        $this->assertEquals(DateHelper::dateTime('2017-03-15'), $day->getDate());
        $this->assertEquals('Az 1848-as forradalom ünnepe', $day->getDescription());
        $this->assertEquals(DayType::get(DayType::NON_WORKING_DAY), $day->getType());
    }

    public function testDayCreationWithEmptyDescription()
    {
        $day = new SpecialDay(
            DateHelper::dateTime('2017-03-18'),
            DayType::get(DayType::RELOCATED_WORKING_DAY)
        );
        $this->assertEquals(DateHelper::dateTime('2017-03-18'), $day->getDate());
        $this->assertEquals('', $day->getDescription());
    }
}
