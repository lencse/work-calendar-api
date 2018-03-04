<?php

namespace Test\Unit\Application;

use Lencse\Application\Controller\GetAllTypesController;
use Lencse\Application\Controller\GetTypeController;
use Lencse\Application\Exception\NotFoundException;
use Lencse\WorkCalendar\Calendar\DayType\DayType;
use PHPUnit\Framework\TestCase;
use Test\Unit\Calendar\Mock\MockDayTypeRepository;

class TypeControllerTest extends TestCase
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

    public function testGetType()
    {
        $controller = new GetTypeController(new MockDayTypeRepository());
        $response = $controller(MockDayTypeRepository::WEEKEND);
        $this->assertEquals('weekend', $response->getKey());
    }

    public function testExceptionForWrongType()
    {
        $controller = new GetTypeController(new MockDayTypeRepository());
        $this->expectException(NotFoundException::class);
        $controller('invalid');
    }
}
