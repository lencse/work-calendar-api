<?php

namespace Lencse\Application\Routing;

use Lencse\Application\DependencyInjection\Caller;
use Psr\Http\Message\ServerRequestInterface;

class RouteCaller
{

    /**
     * @var Caller
     */
    private $caller;

    /**
     * @var Router
     */
    private $router;

    public function __construct(Caller $caller, Router $router)
    {
        $this->caller = $caller;
        $this->router = $router;
    }

    /**
     * @param ServerRequestInterface $request
     * @return object|array
     */
    public function call(ServerRequestInterface $request)
    {
        $route = $this->router->route($request);
        return  $this->caller->call($route->getHandlerClass(), $route->getParams());
    }
}
