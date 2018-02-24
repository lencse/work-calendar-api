<?php

namespace Test\Unit\Calendar;

use Lencse\Date\DateHelper;
use Lencse\WorkCalendar\Calendar\Calendar;
use Lencse\WorkCalendar\Calendar\CalendarImp;
use Lencse\WorkCalendar\Calendar\Day\DayImp;
use Lencse\WorkCalendar\Calendar\Repository\DayRepository;
use Lencse\WorkCalendar\Calendar\Repository\DayTypeRepository;
use Lencse\WorkCalendar\Calendar\Repository\HuDayTypeRepository;
use Lencse\WorkCalendar\Calendar\Repository\SpecialDayRepository;
use PHPUnit\Framework\TestCase;

class CalendarTest extends TestCase
{

    /**
     * @var Calendar
     */
    private $calendar;

    /**
     * @var DayTypeRepository
     */
    private $dayTypeRepo;

    /**
     * @var DayRepository
     */
    private $dayRepo;

    protected function setUp()
    {
        $this->dayTypeRepo = new HuDayTypeRepository();
        $this->dayRepo = new SpecialDayRepository();
        $this->dayRepo->add(
            new DayImp(
                DateHelper::dateTime('2018-03-15'),
                $this->dayTypeRepo->get(HuDayTypeRepository::NON_WORKING_DAY),
                'description'
            )
        );
        $this->calendar = new CalendarImp($this->dayTypeRepo, $this->dayRepo);
    }

    public function testGetWorkingDay()
    {
        $day = $this->calendar->getDay(DateHelper::dateTime('2018-02-23'));
        $this->assertEquals(DateHelper::dateTime('2018-02-23'), $day->getDate());
        $this->assertEquals($this->dayTypeRepo->get(HuDayTypeRepository::WORKING_DAY), $day->getType());
        $this->assertEquals('', $day->getDescription());
    }

    public function testGetWeekend()
    {
        $day = $this->calendar->getDay(DateHelper::dateTime('2018-02-24'));
        $this->assertEquals(DateHelper::dateTime('2018-02-24'), $day->getDate());
        $this->assertEquals($this->dayTypeRepo->get(HuDayTypeRepository::WEEKEND), $day->getType());
        $this->assertEquals('', $day->getDescription());
    }

    public function testGetNonWorkingDay()
    {
        $day = $this->calendar->getDay(DateHelper::dateTime('2018-03-15'));
        $this->assertEquals(DateHelper::dateTime('2018-03-15'), $day->getDate());
        $this->assertEquals($this->dayTypeRepo->get(HuDayTypeRepository::NON_WORKING_DAY), $day->getType());
        $this->assertEquals('description', $day->getDescription());
    }
}
