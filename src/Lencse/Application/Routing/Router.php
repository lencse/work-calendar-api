<?php

namespace Lencse\Application\Routing;

use Psr\Http\Message\ServerRequestInterface;

interface Router
{

    public function add(Route $route): void;

    public function route(ServerRequestInterface $request): RoutingResponse;
}
