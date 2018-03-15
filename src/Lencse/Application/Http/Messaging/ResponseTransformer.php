<?php

namespace Lencse\Application\Http\Messaging;

use Psr\Http\Message\ResponseInterface;

interface ResponseTransformer
{

    public function createResponse(string $body): ResponseInterface;
}
