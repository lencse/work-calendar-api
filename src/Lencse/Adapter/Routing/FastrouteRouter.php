<?php

namespace Lencse\Adapter\Routing;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
use Lencse\Application\Exception\BadMethodException;
use Lencse\Application\Exception\NotFoundException;
use Lencse\Application\Routing\Route;
use Lencse\Application\Routing\Router;
use Lencse\Application\Routing\RoutingResult;
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
        $this->routes[] = new Route($route->getPath() . '/', $route->getHandlerClass());
    }

    public function route(ServerRequestInterface $request): RoutingResult
    {
        $dispatcher = simpleDispatcher(function (RouteCollector $collector): void {
            foreach ($this->routes as $route) {
                $collector->addRoute('GET', $route->getPath(), $route->getHandlerClass());
            }
        });

        $routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getUri()->getPath());

        if (Dispatcher::METHOD_NOT_ALLOWED === $routeInfo[0]) {
            throw new BadMethodException();
        }

        if (Dispatcher::FOUND !== $routeInfo[0]) {
            throw new NotFoundException();
        }

        $handler = (string) $routeInfo[1];
        $routeParams = (array) $routeInfo[2];

        if (class_exists($handler)) {
            $reflection = new \ReflectionClass($handler);
            /** @var \ReflectionParameter[] $params */
            $params = $reflection->getMethod('__invoke')->getParameters();
            foreach ($params as $param) {
                if (ServerRequestInterface::class === $param->getType()->getName()) {
                    $routeParams[$param->getName()] = $request;
                }
            }
        }

        return new RoutingResult($handler, $routeParams);
    }
}
