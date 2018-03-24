<?php

namespace Test\Unit\Calendar;

use Lencse\Date\DateHelper;
use Lencse\WorkCalendar\Calendar\Calendar;
use Lencse\WorkCalendar\Calendar\Day\Entity\Day;
use Lencse\WorkCalendar\Calendar\Day\Repository\DayRepository;
use Lencse\WorkCalendar\Calendar\DayType\Repository\DayTypeRepository;
use Lencse\WorkCalendar\Calendar\Repository\SpecialDayRepository;
use Lencse\WorkCalendar\Calendar\Day\Repository\SpecialDayRepositoryFactory;
use PHPUnit\Framework\TestCase;
use Test\Unit\Calendar\Mock\MockDayRepositoryFactory;
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

    protected function setUp(): void
    {
        $this->dayTypeRepo = new MockDayTypeRepository();
        $factory = new MockDayRepositoryFactory($this->dayTypeRepo);
        $this->dayRepo = $factory();
        $this->calendar = new Calendar($this->dayTypeRepo, $this->dayRepo);
    }
}
