<?php

namespace Lencse\Adapter\DependencyInjection;

use Auryn\Injector;
use Lencse\Application\DependencyInjection\Caller;
use Lencse\Application\DependencyInjection\Dic;

class AurynDic implements Dic, Caller
{

    /**
     * @var Injector
     */
    private $auryn;

    public function __construct()
    {
        $this->auryn = new Injector();
    }


    public function bind(string $abstract, string $concrete): void
    {
        $this->auryn->alias($abstract, $concrete);
    }

    public function make(string $class): object
    {
        /** @var object $result */
        $result = $this->auryn->make($class);
        return $result;
    }

    /**
     * @param string $callableClass
     * @param mixed[] $params
     * @return mixed
     *
     * @psalm-suppress MixedAssignment
     */
    public function call(string $callableClass, array $params = [])
    {
        $execParams = [];
        foreach ($params as $key => $value) {
            $execParams[":$key"] = $value;
        }

        return $this->auryn->execute($callableClass, $execParams);
    }

    public function factory(string $class, string $factoryClass): void
    {
        $this->auryn->delegate($class, $factoryClass);
    }

    public function share(string $class): void
    {
        $this->auryn->share($this->make($class));
    }

    public function shareInstance(string $class, $instance): void
    {
        $this->auryn->share($instance);
        $this->bind($class, get_class($instance));
    }
}
