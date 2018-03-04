<?php

namespace Test\Unit\Application;

use Lencse\Application\Controller\GetAllTypesController;
use Lencse\WorkCalendar\Calendar\DayType\DayType;
use PHPUnit\Framework\TestCase;
use Test\Unit\Calendar\Mock\MockDayTypeRepository;

class ControllerTest extends TestCase
{

    public function testGetAllTypes()
    {
        $controller = new GetAllTypesController(new MockDayTypeRepository());
        $response = $controller();
        $this->assertCount(3, $response);
        foreach ($response as $item) {
            $this->assertInstanceOf(DayType::class, $item);
        }
    }
}
