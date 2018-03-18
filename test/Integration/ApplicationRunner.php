<?php

namespace Test\Integration;

use GuzzleHttp\Psr7\ServerRequest;
use Lencse\Application\Bootstrap;
use Psr\Http\Message\ResponseInterface;

class ApplicationRunner
{

    public function callDayTypesRoute(): ResponseInterface
    {
        $config = require __DIR__ . '/../../config/config.php';
        $bootstrap = new Bootstrap($config);
        $app = $bootstrap->createApplication();
        $request = new ServerRequest(
            'GET',
            '/api/v1/day-types'
        );
        return $app->run($request);
    }

    public function callDayTypeRoute(): ResponseInterface
    {
        $config = require __DIR__ . '/../../config/config.php';
        $bootstrap = new Bootstrap($config);
        $app = $bootstrap->createApplication();
        $request = new ServerRequest(
            'GET',
            '/api/v1/day-types/switched-working-day'
        );
        return $app->run($request);
    }

    public function callSpecialDaysRoute(): ResponseInterface
    {
        $config = require __DIR__ . '/../../config/config.php';
        $bootstrap = new Bootstrap($config);
        $app = $bootstrap->createApplication();
        $request = new ServerRequest(
            'GET',
            '/api/v1/days/special'
        );
        return $app->run($request);
    }

    public function callSpecialDaysForAYearRoute(): ResponseInterface
    {
        $config = require __DIR__ . '/../../config/config.php';
        $bootstrap = new Bootstrap($config);
        $app = $bootstrap->createApplication();
        $request = new ServerRequest(
            'GET',
            '/api/v1/days/special/2018'
        );
        return $app->run($request);
    }

    public function callADayRoute(): ResponseInterface
    {
        $config = require __DIR__ . '/../../config/config.php';
        $bootstrap = new Bootstrap($config);
        $app = $bootstrap->createApplication();
        $request = new ServerRequest(
            'GET',
            '/api/v1/days/2018-02-01'
        );
        return $app->run($request);
    }

    public function callDayIntervalRoute(string $from, string $to): ResponseInterface
    {
        $config = require __DIR__ . '/../../config/config.php';
        $bootstrap = new Bootstrap($config);
        $app = $bootstrap->createApplication();
        $request = new ServerRequest(
            'GET',
            '/api/v1/days'
        );
        return $app->run($request->withQueryParams(['from' => $from, 'to' => $to]));
    }
}
