<?php

namespace Test\Unit\Application;

use Lencse\Application\Controller\GetADayController;
use Lencse\WorkCalendar\Calendar\Repository\Calendar;
use Lencse\WorkCalendar\Calendar\Repository\CalendarImp;
use Lencse\WorkCalendar\Calendar\Repository\DayRepository;
use Lencse\WorkCalendar\Calendar\Repository\SpecialDayRepositoryFactory;
use PHPUnit\Framework\TestCase;
use Test\Unit\Calendar\Mock\MockDayTypeRepository;

class DayControllerTest extends TestCase
{

    /**
     * @var DayRepository
     */
    private $repo;

    /**
     * @var Calendar
     */
    private $calendar;

    protected function setUp()
    {
        $factory = new SpecialDayRepositoryFactory(
            new MockDayTypeRepository(),
            [
                ['2018-03-15', MockDayTypeRepository::NON_WORKING_DAY, ''],
                ['2019-03-15', MockDayTypeRepository::NON_WORKING_DAY, '']
            ]
        );
        $this->repo = $factory->createRepository();
        $this->calendar = new CalendarImp(new MockDayTypeRepository(), $this->repo);
    }

    public function testGetADay()
    {
        $controller = new GetADayController($this->calendar);
        $this->assertEquals(MockDayTypeRepository::NON_WORKING_DAY, $controller('2018-03-15')->getType()->getKey());
        $this->assertEquals(MockDayTypeRepository::WORKING_DAY, $controller('2018-03-14')->getType()->getKey());
    }
}
