<?php

namespace Lencse\Application\Http\JsonApi;

interface JsonApi
{

    /**
     * @param array|object $resource
     * @return string
     */
    public function transform($resource): string;
}
