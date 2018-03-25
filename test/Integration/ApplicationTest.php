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

    public function testNotFound()
    {
        $app = Bootstrap::createApplication();
        $request = new ServerRequest(
            'GET',
            '/error'
        );
        $response = $app->run($request);

        $this->assertEquals(404, $response->getStatusCode());
        $result = json_decode($response->getBody(), true);
        $this->assertEquals(404, $result['errors']['0']['code']);
        $this->assertEquals('Not Found', $result['errors']['0']['status']);
    }

    public function testBadMethod()
    {
        $app = Bootstrap::createApplication();
        $request = new ServerRequest(
            'POST',
            '/api/v1/day-types'
        );
        $response = $app->run($request);

        $this->assertEquals(405, $response->getStatusCode());
        $result = json_decode($response->getBody(), true);
        $this->assertEquals(405, $result['errors']['0']['code']);
        $this->assertEquals('Method Not Allowed', $result['errors']['0']['status']);
    }

    public function testBadRequest()
    {
        $app = Bootstrap::createApplication();

        $request = new ServerRequest(
            'GET',
            '/api/v1/days'
        );
        $response = $app->run($request->withQueryParams(['from' => '2018-01-01']));

        $this->assertEquals(400, $response->getStatusCode());
        $result = json_decode($response->getBody(), true);
        $this->assertEquals(400, $result['errors']['0']['code']);
        $this->assertEquals('Bad Request', $result['errors']['0']['status']);
        $this->assertEquals("Missing parameters: 'to'", $result['errors']['0']['title']);
    }

    public function testBadRequestForBadFormatl()
    {
        $app = Bootstrap::createApplication();

        $request = new ServerRequest(
            'GET',
            '/api/v1/days'
        );
        $response = $app->run($request->withQueryParams(['from' => '2018-01-01', 'to' => '2018-01-xx']));

        $this->assertEquals(400, $response->getStatusCode());
        $result = json_decode($response->getBody(), true);
        $this->assertEquals(400, $result['errors']['0']['code']);
        $this->assertEquals('Bad Request', $result['errors']['0']['status']);
        $this->assertEquals('Invalid date format: 2018-01-xx', $result['errors']['0']['title']);
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
