<?php

namespace Lencse\Application\DependencyInjection;

interface Dic
{

    public function bind(string $abstract, string $concrete): void;

    public function make(string $class): object;

    /**
     * @param string $callableClass
     * @param mixed[] $params
     * @return mixed
     */
    public function call(string $callableClass, array $params = []);

    public function factory(string $class, string $factoryClass): void;
}
