<?php

namespace Test\Integration;

use GuzzleHttp\Psr7\ServerRequest;
use Lencse\Application\Bootstrap;
use PHPUnit\Framework\TestCase;

/**
 * @group app
 */
class ApplicationTest extends TestCase
{

    public function testDayTypesRoute()
    {
        $config = require __DIR__ . '/../../config/config.php';
        $bootstrap = new Bootstrap($config);
        $app = $bootstrap->createApplication();
        $request = new ServerRequest(
            'GET',
            '/api/v1/day-types'
        );
        $response = $app->run($request);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testDayTypeRoute()
    {
        $config = require __DIR__ . '/../../config/config.php';
        $bootstrap = new Bootstrap($config);
        $app = $bootstrap->createApplication();
        $request = new ServerRequest(
            'GET',
            '/api/v1/day-types/switched-working-day'
        );
        $response = $app->run($request);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testSpecialDaysRoute()
    {
        $config = require __DIR__ . '/../../config/config.php';
        $bootstrap = new Bootstrap($config);
        $app = $bootstrap->createApplication();
        $request = new ServerRequest(
            'GET',
            '/api/v1/days/special'
        );
        $response = $app->run($request);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testSpecialDaysForAYearRoute()
    {
        $config = require __DIR__ . '/../../config/config.php';
        $bootstrap = new Bootstrap($config);
        $app = $bootstrap->createApplication();
        $request = new ServerRequest(
            'GET',
            '/api/v1/days/special/2018'
        );
        $response = $app->run($request);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testADayRoute()
    {
        $config = require __DIR__ . '/../../config/config.php';
        $bootstrap = new Bootstrap($config);
        $app = $bootstrap->createApplication();
        $request = new ServerRequest(
            'GET',
            '/api/v1/days/2018-02-01'
        );
        $response = $app->run($request);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testDayIntervalRoute()
    {
        $config = require __DIR__ . '/../../config/config.php';
        $bootstrap = new Bootstrap($config);
        $app = $bootstrap->createApplication();
        $request = new ServerRequest(
            'GET',
            '/api/v1/days'
        );
        $response = $app->run($request->withQueryParams(['from' => '2018-01-01', 'to' => '2018-02-02']));

        $this->assertEquals(200, $response->getStatusCode());
    }
}
