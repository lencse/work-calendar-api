<?php

namespace Lencse\Adapter\Http\Messaging;

use GuzzleHttp\Psr7\Response;
use Lencse\Application\Http\Messaging\ResponseTransformer;
use Psr\Http\Message\ResponseInterface;

class GuzzleHttpResponseTransformer implements ResponseTransformer
{

    public function createResponse(string $body): ResponseInterface
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/vnd.api+json'],
            $body
        );

        return $response;
    }

    public function createErrorResponse(string $body, int $errorCode): ResponseInterface
    {
        $response = new Response(
            $errorCode,
            ['Content-Type' => 'application/vnd.api+json'],
            $body
        );

        return $response;
    }
}
