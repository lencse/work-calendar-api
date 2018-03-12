<?php

namespace Test\Unit\Adapter;

use GuzzleHttp\Psr7\ServerRequest;
use Lencse\Adapter\Routing\FastrouteRouter;
use Lencse\Application\Exception\NotFoundException;
use Lencse\Application\Routing\Route;
use PHPUnit\Framework\TestCase;

class FastrouteRouterTest extends TestCase
{

    public function testRouting()
    {
        $router = new FastrouteRouter();
        $router->add(new Route('/test', 'TestHandler'));

        $request = new ServerRequest(
            'GET',
            '/test'
        );

        $response = $router->route($request);

        $this->assertEquals('TestHandler', $response->getHandlerClass());
    }

    public function testParams()
    {
        $router = new FastrouteRouter();
        $router->add(new Route('/test/{id}', 'TestHandler'));

        $request = new ServerRequest(
            'GET',
            '/test/1'
        );

        $response = $router->route($request);

        $this->assertEquals(['id' => 1], $response->getParams());
    }

    public function testNotFound()
    {
        $router = new FastrouteRouter();

        $request = new ServerRequest(
            'GET',
            '/test/1'
        );

        $this->expectException(NotFoundException::class);
        $router->route($request);
    }
}
