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

    public function testApplication()
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
}
