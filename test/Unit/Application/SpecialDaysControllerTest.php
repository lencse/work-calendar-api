<?php

namespace Test\Unit\Application;

use Lencse\Application\Controller\GetAllSpecialDaysController;
use Lencse\Application\Controller\GetSpecialDaysForYearController;
use Lencse\WorkCalendar\Calendar\Day\Repository\DayRepository;
use Lencse\WorkCalendar\Calendar\Day\Repository\SpecialDayRepositoryFactory;
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
        $this->repo = $factory();
    }

    public function testGetAllDays(): void
    {
        $controller = new GetAllSpecialDaysController($this->repo);
        $response = $controller();

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
        $response = $controller(2000);

        $this->assertEquals([], $response);
    }
}
