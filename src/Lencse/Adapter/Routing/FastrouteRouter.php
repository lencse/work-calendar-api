<?php

namespace Lencse\Adapter\Routing;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
use Lencse\Application\Exception\BadMethodException;
use Lencse\Application\Exception\NotFoundException;
use Lencse\Application\Routing\Route;
use Lencse\Application\Routing\Router;
use Lencse\Application\Routing\RoutingResponse;
use Psr\Http\Message\ServerRequestInterface;

class FastrouteRouter implements Router
{

    /**
     * @var Route[]
     */
    private $routes = [];

    public function add(Route $route): void
    {
        $this->routes[] = $route;
    }

    public function route(ServerRequestInterface $request): RoutingResponse
    {
        $dispatcher = simpleDispatcher(function (RouteCollector $collector): void {
            foreach ($this->routes as $route) {
                $collector->addRoute('GET', $route->getPath(), $route->getHandlerClass());
            }
        });

        $routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getUri()->getPath());

        if (Dispatcher::FOUND === $routeInfo[0]) {
            return new RoutingResponse((string) $routeInfo[1], (array) $routeInfo[2]);
        }

        if (Dispatcher::METHOD_NOT_ALLOWED === $routeInfo[0]) {
            throw new BadMethodException();
        }

        throw new NotFoundException();
    }
}
