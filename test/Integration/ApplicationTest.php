<?php

namespace Test\Integration;

use GuzzleHttp\Psr7\ServerRequest;
use Lencse\Application\Bootstrap;
use Lencse\Date\DateHelper;
use PHPUnit\Framework\TestCase;

class ApplicationTest extends TestCase
{

    /**
     * @var ApplicationRunner
     */
    private $app;

    protected function setUp()
    {
        $this->app = new ApplicationRunner();
    }

    public function testDayTypesRoute()
    {
        $response = $this->app->callDayTypesRoute();
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testDayTypeRoute()
    {
        $response = $this->app->callDayTypeRoute();
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testSpecialDaysRoute()
    {
        $response = $this->app->callSpecialDaysRoute();
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testSpecialDaysForAYearRoute()
    {
        $response = $this->app->callSpecialDaysForAYearRoute();
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testADayRoute()
    {
        $response =$this->app->callADayRoute();
        $this->assertEquals(200, $response->getStatusCode());
        $content = json_decode($response->getBody(), true);
        $this->assertEquals(DateHelper::dateTime('2018-02-01')->format('c'), $content['data']['attributes']['date']);
    }

    public function testDayIntervalRoute()
    {
        $response = $this->app->callDayIntervalRoute('2018-01-01', '2018-01-10');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testTrailingSlash()
    {
        $app = Bootstrap::createApplication();
        $request = new ServerRequest(
            'GET',
            '/api/v1/day-types/'
        );

        $response = $app->run($request);
        $this->assertEquals(200, $response->getStatusCode());
    }
}
