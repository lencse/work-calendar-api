<?php

namespace Lencse\Application;

use Lencse\Application\DependencyInjection\Caller;
use Lencse\Application\Http\JsonApi\JsonApi;
use Lencse\Application\Http\Messaging\ResponseTransformer;
use Lencse\Application\Routing\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Application
{

    /**
     * @var Caller
     */
    private $caller;

    /**
     * @var Router
     */
    private $router;

    /**
     * @var JsonApi
     */
    private $jsonApi;
    
    /**
     * @var ResponseTransformer
     */
    private $responseTransformer;

    public function __construct(
        Caller $caller,
        Router $router,
        JsonApi $jsonApi,
        ResponseTransformer $responseTransformer
    ) {
        $this->caller = $caller;
        $this->router = $router;
        $this->jsonApi = $jsonApi;
        $this->responseTransformer = $responseTransformer;
    }

    public function run(ServerRequestInterface $request): ResponseInterface
    {
        $route = $this->router->route($request);
        $result = $this->caller->call($route->getHandlerClass(), $route->getParams());
        $body = $this->jsonApi->transform($result);

        return $this->responseTransformer->createResponse($body);
    }
}
