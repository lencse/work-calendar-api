<?php

namespace Test\Unit\Application;

use Lencse\Application\Controller\GetADayController;
use Lencse\Application\Controller\GetDayIntervalController;
use Lencse\Application\Exception\BadRequestException;
use Lencse\WorkCalendar\Calendar\Repository\Calendar;
use Lencse\WorkCalendar\Calendar\Repository\CalendarImp;
use Lencse\WorkCalendar\Calendar\Repository\DayRepository;
use Lencse\WorkCalendar\Hu\Repository\HuDayTypeRepository;
use Lencse\WorkCalendar\Hu\Repository\HuSpecialDayRepositoryFactory;
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
        $factory = new HuSpecialDayRepositoryFactory(new HuDayTypeRepository());
        $this->repo = $factory->createRepository();
        $this->calendar = new CalendarImp(new HuDayTypeRepository(), $this->repo);
    }

    public function testGetADay()
    {
        $controller = new GetADayController($this->calendar);
        $this->assertEquals(MockDayTypeRepository::NON_WORKING_DAY, $controller('2018-01-01')->getType()->getKey());
        $this->assertEquals(MockDayTypeRepository::WORKING_DAY, $controller('2018-01-02')->getType()->getKey());
    }

    public function testGetInterval()
    {
        $controller = new GetDayIntervalController($this->calendar);
        $request = new FromArrayRequest([
            'from' => '2017-12-31',
            'to' => '2018-01-02',
        ]);
        $response =  $controller($request);
        $this->assertCount(3, $response);
    }

    public function testExceptionForMissingFrom()
    {
        $controller = new GetDayIntervalController($this->calendar);
        $this->expectException(BadRequestException::class);
        $controller(new FromArrayRequest(['to' => '2018-03-14']));
    }

    public function testExceptionForMissingTo()
    {
        $controller = new GetDayIntervalController($this->calendar);
        $this->expectException(BadRequestException::class);
        $controller(new FromArrayRequest(['from' => '2018-03-14']));
    }
}
