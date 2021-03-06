<?php

namespace Lencse\Application;

use Lencse\Application\Exception\ApplicationException;
use Lencse\Application\Http\JsonApi\JsonApi;
use Lencse\Application\Http\Messaging\ResponseTransformer;
use Lencse\Application\Routing\RouteCaller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Application
{

    /**
     * @var RouteCaller
     */
    private $routeCaller;

    /**
     * @var JsonApi
     */
    private $jsonApi;
    
    /**
     * @var ResponseTransformer
     */
    private $responseTransformer;

    public function __construct(RouteCaller $routeCaller, JsonApi $jsonApi, ResponseTransformer $responseTransformer)
    {
        $this->routeCaller = $routeCaller;
        $this->jsonApi = $jsonApi;
        $this->responseTransformer = $responseTransformer;
    }

    public function run(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $result = $this->routeCaller->call($request);
            $body = $this->jsonApi->transform($result);

            return $this->responseTransformer->createResponse($body);
        } catch (ApplicationException $e) {
            $body = $this->jsonApi->transformException($e);

            return $this->responseTransformer->createErrorResponse($body, $e->getCode());
        }
    }
}
