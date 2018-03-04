<?php

namespace Test\Unit\Application;

use Lencse\Application\Controller\GetAllSpecialDaysController;
use Lencse\Application\Controller\GetAllTypesController;
use Lencse\Application\Controller\GetTypeController;
use Lencse\Application\Exception\NotFoundException;
use Lencse\WorkCalendar\Calendar\DayType\DayType;
use Lencse\WorkCalendar\Calendar\Repository\DayRepository;
use Lencse\WorkCalendar\Calendar\Repository\SpecialDayRepositoryFactory;
use PHPUnit\Framework\TestCase;
use Test\Unit\Calendar\Mock\MockDayTypeRepository;

class SpecialDaysControllerTest extends TestCase
{

    public function testGetAllDays()
    {
        $factory = new SpecialDayRepositoryFactory(
            new MockDayTypeRepository(),
            [
                ['2018-03-15', MockDayTypeRepository::NON_WORKING_DAY, '']
            ]
        );
        $controller = new GetAllSpecialDaysController($factory->createRepository());
        $response = $controller();

        $this->assertCount(1, $response);
    }

//    public function testGetType()
//    {
//        $controller = new GetTypeController(new MockDayTypeRepository());
//        $response = $controller(MockDayTypeRepository::WEEKEND);
//        $this->assertEquals('weekend', $response->getKey());
//    }
//
//    public function testExceptionForWrongType()
//    {
//        $controller = new GetTypeController(new MockDayTypeRepository());
//        $this->expectException(NotFoundException::class);
//        $controller('invalid');
//    }
}
