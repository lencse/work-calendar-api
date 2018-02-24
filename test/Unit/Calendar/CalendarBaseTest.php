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
}
