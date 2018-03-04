<?php

namespace Test\Unit\Calendar;

use Lencse\Date\DateHelper;
use Lencse\WorkCalendar\Calendar\Repository\Calendar;
use Lencse\WorkCalendar\Calendar\Repository\CalendarImp;
use Lencse\WorkCalendar\Calendar\Day\Day;
use Lencse\WorkCalendar\Calendar\Repository\DayRepository;
use Lencse\WorkCalendar\Calendar\Repository\DayTypeRepository;
use Lencse\WorkCalendar\Calendar\Repository\SpecialDayRepository;
use PHPUnit\Framework\TestCase;
use Test\Unit\Calendar\Mock\MockDayTypeRepository;

abstract class CalendarBaseTest extends TestCase
{

    /**
     * @var Calendar
     */
    protected $calendar;

    /**
     * @var DayTypeRepository
     */
    protected $dayTypeRepo;

    /**
     * @var DayRepository
     */
    protected $dayRepo;

    protected function setUp()
    {
        $this->dayTypeRepo = new MockDayTypeRepository();
        $this->dayRepo = new SpecialDayRepository();
        $this->dayRepo->add(
            new Day(
                DateHelper::dateTime('2018-03-15'),
                $this->dayTypeRepo->get(MockDayTypeRepository::NON_WORKING_DAY),
                'description'
            )
        );
        $this->dayRepo->add(
            new Day(
                DateHelper::dateTime('2015-03-15'),
                $this->dayTypeRepo->get(MockDayTypeRepository::NON_WORKING_DAY),
                'description'
            )
        );
        $this->dayRepo->add(
            new Day(
                DateHelper::dateTime('2015-10-23'),
                $this->dayTypeRepo->get(MockDayTypeRepository::NON_WORKING_DAY),
                'description'
            )
        );
        $this->calendar = new CalendarImp($this->dayTypeRepo, $this->dayRepo);
    }
}
