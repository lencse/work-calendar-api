<?php

namespace Test\Unit\Calendar;

use Lencse\Date\DateHelper;
use Lencse\WorkCalendar\Calendar\Calendar;
use Lencse\WorkCalendar\Calendar\CalendarImp;
use Lencse\WorkCalendar\Calendar\Repository\DayTypeRepository;
use Lencse\WorkCalendar\Calendar\Repository\HuDayTypeRepository;
use PHPUnit\Framework\TestCase;

class CalendarTest extends TestCase
{

    /**
     * @var Calendar
     */
    private $factory;

    /**
     * @var DayTypeRepository
     */
    private $dayTypeRepo;

    protected function setUp()
    {
        $this->dayTypeRepo = new HuDayTypeRepository();
        $this->factory = new CalendarImp($this->dayTypeRepo);
    }

    public function testGetWorkingDay()
    {
        $day = $this->factory->createDayForDate(DateHelper::dateTime('2018-02-23'));
        $this->assertEquals(DateHelper::dateTime('2018-02-23'), $day->getDate());
        $this->assertEquals($this->dayTypeRepo->get(HuDayTypeRepository::WORKING_DAY), $day->getType());
        $this->assertEquals('', $day->getDescription());
    }

    public function testGetWeekend()
    {
        $day = $this->factory->createDayForDate(DateHelper::dateTime('2018-02-24'));
        $this->assertEquals(DateHelper::dateTime('2018-02-24'), $day->getDate());
        $this->assertEquals($this->dayTypeRepo->get(HuDayTypeRepository::WEEKEND), $day->getType());
        $this->assertEquals('', $day->getDescription());
    }
}
