<?php

namespace Test\Unit\Application;

use Lencse\Application\Controller\GetSpecialDaysController;
use Lencse\WorkCalendar\Calendar\Repository\DayRepository;
use Lencse\WorkCalendar\Calendar\Repository\SpecialDayRepositoryFactory;
use PHPUnit\Framework\TestCase;
use Test\Unit\Calendar\Mock\MockDayTypeRepository;

class SpecialDaysControllerTest extends TestCase
{

    /**
     * @var DayRepository
     */
    private $repo;

    protected function setUp()
    {
        $factory =  new SpecialDayRepositoryFactory(
            new MockDayTypeRepository(),
            [
                ['2018-03-15', MockDayTypeRepository::NON_WORKING_DAY, ''],
                ['2019-03-15', MockDayTypeRepository::NON_WORKING_DAY, '']
            ]
        );
        $this->repo = $factory->createRepository();
    }

    public function testGetAllDays()
    {
        $controller = new GetSpecialDaysController($this->repo);
        $response = $controller(new FromArrayRequest([]));

        $this->assertCount(2, $response);
    }

    public function testGetForYear()
    {
        $controller = new GetSpecialDaysController($this->repo);
        $response = $controller(new FromArrayRequest(['year' => 2018]));

        $this->assertCount(1, $response);
    }

    public function testGetForEmptyYear()
    {
        $controller = new GetSpecialDaysController($this->repo);
        $response = $controller(new FromArrayRequest(['year' => 2017]));

        $this->assertEquals([], $response);
    }

//    public function testGetForYear()
//    {
//        $controller = new GetAllSpecialDaysForYearController($this->repo);
//        $response = $controller();
////
//        $this->assertCount(1, $response);
//    }

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
