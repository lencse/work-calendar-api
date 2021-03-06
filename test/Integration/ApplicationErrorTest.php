<?php

namespace Test\Integration;

use GuzzleHttp\Psr7\ServerRequest;
use Lencse\Application\Bootstrap;
use PHPUnit\Framework\TestCase;

class ApplicationErrorTest extends TestCase
{

    /**
     * @var ApplicationRunner
     */
    private $app;

    protected function setUp()
    {
        $this->app = new ApplicationRunner();
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
}
