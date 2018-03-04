<?php

namespace Test\Unit\Application;

use Lencse\Application\Controller\GetAllTypesController;
use Lencse\WorkCalendar\Calendar\Repository\CalendarImp;
use Lencse\WorkCalendar\Calendar\DayType\DayType;
use Lencse\WorkCalendar\Calendar\Repository\SpecialDayRepository;
use PHPUnit\Framework\TestCase;
use Test\Unit\Calendar\Mock\MockDayTypeRepository;

class ControllerTest extends TestCase
{

    public function testGetAllTypes()
    {
        $calendar = new CalendarImp(new MockDayTypeRepository(), new SpecialDayRepository());
        $controller = new GetAllTypesController($calendar);
        $response = $controller();
        $this->assertCount(3, $response);
        foreach ($response as $item) {
            $this->assertInstanceOf(DayType::class, $item);
        }
    }
}
