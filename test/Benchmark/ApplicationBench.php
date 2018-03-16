<?php

namespace Test\Benchmark;

use GuzzleHttp\Psr7\ServerRequest;
use Lencse\Application\Bootstrap;

class ApplicationBench
{

    public function benchDayTypesRoute()
    {
        $config = require __DIR__ . '/../../config/config.php';
        $bootstrap = new Bootstrap($config);
        $app = $bootstrap->createApplication();
        $request = new ServerRequest(
            'GET',
            '/api/v1/day-types'
        );
        $app->run($request);
    }

    public function benchDayIntervalRoute()
    {
        $config = require __DIR__ . '/../../config/config.php';
        $bootstrap = new Bootstrap($config);
        $app = $bootstrap->createApplication();
        $request = new ServerRequest(
            'GET',
            '/api/v1/days'
        );
        $app->run($request->withQueryParams(['from' => '2018-01-01', 'to' => '2018-12-31']));
    }
}
