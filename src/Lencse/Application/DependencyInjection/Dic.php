<?php

namespace Lencse\Application\DependencyInjection;

interface Dic
{

    public function bind(string $abstract, string $concrete): void;

    public function make(string $class): object;

    public function factory(string $class, string $factoryClass): void;

    public function share(string $class, $instance): void;
}
