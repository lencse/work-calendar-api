<?php

namespace Test\Unit\Application;

use GuzzleHttp\Psr7\ServerRequest;
use Lencse\Application\Controller\GetADayController;
use Lencse\Application\Controller\GetDayIntervalController;
use Lencse\Application\Exception\BadRequestException;
use Lencse\WorkCalendar\Calendar\Repository\Calendar;
use Lencse\WorkCalendar\Calendar\Repository\DayRepository;
use Lencse\WorkCalendar\Hu\Repository\HuDayTypeRepository;
use Lencse\WorkCalendar\Hu\Repository\HuSpecialDayRepositoryFactory;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
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
        $this->repo = $factory();
        $this->calendar = new Calendar(new HuDayTypeRepository(), $this->repo);
    }

    public function testGetADay(): void
    {
        $controller = new GetADayController($this->calendar);
        $this->assertEquals(MockDayTypeRepository::NON_WORKING_DAY, $controller('2018-01-01')->getType()->getKey());
        $this->assertEquals(MockDayTypeRepository::WORKING_DAY, $controller('2018-01-02')->getType()->getKey());
    }

    public function testGetInterval(): void
    {
        $controller = new GetDayIntervalController($this->calendar);
        $request = $this->createRequest([
            'from' => '2017-12-31',
            'to' => '2018-01-02',
        ]);
        $response =  $controller($request);
        $this->assertCount(3, $response);
    }

    public function testExceptionForMissingFrom(): void
    {
        $controller = new GetDayIntervalController($this->calendar);
        $this->expectException(BadRequestException::class);
        $controller($this->createRequest(['to' => '2018-03-14']));
    }

    public function testExceptionForMissingTo(): void
    {
        $controller = new GetDayIntervalController($this->calendar);
        $this->expectException(BadRequestException::class);
        $controller($this->createRequest(['from' => '2018-03-14']));
    }

    private function createRequest(array $params): ServerRequestInterface
    {
        $request = new ServerRequest(
            'GET',
            '/'
        );

        return $request->withQueryParams($params);
    }
}
