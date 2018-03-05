<?php

namespace Test\Unit\Application;

use Lencse\Application\Http\Request;

class FromArrayRequest implements Request
{

    /**
     * @var array
     */
    private $params = [];

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function hasParam(string $key): bool
    {
        return array_key_exists($key, $this->params);
    }

    public function getParam(string $key)
    {
        return $this->params[$key];
    }
}
