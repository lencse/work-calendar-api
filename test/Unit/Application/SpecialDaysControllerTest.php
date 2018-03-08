<?php

namespace Test\Unit\Application;

use Lencse\Application\Controller\GetAllSpecialDaysController;
use Lencse\Application\Controller\GetSpecialDaysForYearController;
use Lencse\WorkCalendar\Calendar\Repository\DayRepository;
use Lencse\WorkCalendar\Calendar\Repository\SpecialDayRepositoryFactory;
use Lencse\WorkCalendar\Hu\Repository\HuDayTypeRepository;
use Lencse\WorkCalendar\Hu\Repository\HuSpecialDayRepositoryFactory;
use PHPUnit\Framework\TestCase;
use Test\Unit\Calendar\Mock\MockDayTypeRepository;

class SpecialDaysControllerTest extends TestCase
{

    /**
     * @var DayRepository
     */
    private $repo;

    protected function setUp(): void
    {
        $factory = new HuSpecialDayRepositoryFactory(new HuDayTypeRepository());
        $this->repo = $factory->createRepository();
    }

    public function testGetAllDays(): void
    {
        $controller = new GetAllSpecialDaysController($this->repo);
        $response = $controller(new FromArrayRequest([]));

        $this->assertEquals($this->repo->getAll(), $response);
    }

    public function testGetForYear(): void
    {
        $controller = new GetSpecialDaysForYearController($this->repo);
        $response = $controller(2018);

        $this->assertEquals($this->repo->getForYear(2018), $response);
    }

    public function testGetForEmptyYear(): void
    {
        $controller = new GetSpecialDaysForYearController($this->repo);
        $response = $controller(2017);

        $this->assertEquals([], $response);
    }
}
