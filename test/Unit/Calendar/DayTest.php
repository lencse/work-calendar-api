<?php

namespace Test\Unit\Calendar;

use Lencse\Date\DateHelper;
use Lencse\WorkCalendar\Calendar\Day\DayImp;
use Lencse\WorkCalendar\Calendar\DayType\DayTypeImp;
use PHPUnit\Framework\TestCase;

class DayTest extends TestCase
{

    public function testDayCreation()
    {
        $day = new DayImp(
            DateHelper::dateTime('2018-03-15'),
            new DayTypeImp('key', 'name', true, false),
            'Az 1848-as forradalom ünnepe'
        );
        $this->assertEquals(DateHelper::dateTime('2018-03-15'), $day->getDate());
        $this->assertEquals('Az 1848-as forradalom ünnepe', $day->getDescription());
        $this->assertEquals(new DayTypeImp('key', 'name', true, false), $day->getType());
    }

    public function testDayCreationWithEmptyDescription()
    {
        $day = new DayImp(
            DateHelper::dateTime('2017-03-18'),
            new DayTypeImp('key', 'name', true, false)
        );
        $this->assertEquals(DateHelper::dateTime('2017-03-18'), $day->getDate());
        $this->assertEquals('', $day->getDescription());
    }
}
