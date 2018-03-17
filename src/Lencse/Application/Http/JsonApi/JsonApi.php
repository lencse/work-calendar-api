<?php

namespace Lencse\Application\Http\JsonApi;

use Lencse\Application\Exception\ApplicationException;

interface JsonApi
{

    /**
     * @param array|object $resource
     * @return string
     */
    public function transform($resource): string;

    public function transformException(ApplicationException $exception): string;
}
