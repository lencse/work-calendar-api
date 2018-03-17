<?php

namespace Test\Unit\Adapter;

use GuzzleHttp\Psr7\ServerRequest;
use Lencse\Adapter\Routing\FastrouteRouter;
use Lencse\Application\Controller\GetDayIntervalController;
use Lencse\Application\Exception\BadMethodException;
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

    public function testRequestParams()
    {
        $router = new FastrouteRouter();
        $router->add(new Route('/test', GetDayIntervalController::class));

        $request = new ServerRequest(
            'GET',
            '/test'
        );

        $response = $router->route($request);

        $this->assertEquals(['request' => $request], $response->getParams());
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

    public function testBadMethod()
    {
        $router = new FastrouteRouter();
        $router->add(new Route('/test/{id}', 'TestHandler'));

        $request = new ServerRequest(
            'POST',
            '/test/1'
        );

        $this->expectException(BadMethodException::class);
        $router->route($request);
    }

    public function testParameterFormat()
    {
        $router = new FastrouteRouter();
        $router->add(new Route('/test/{day:\d{4}-\d{2}-\d{2}}', 'TestHandler'));

        $request = new ServerRequest(
            'POST',
            '/test/1'
        );

        $this->expectException(NotFoundException::class);
        $router->route($request);
    }
}
