<?php

namespace Lencse\Application;

use Lencse\Application\DependencyInjection\Caller;
use Lencse\Application\DependencyInjection\Dic;
use Lencse\Application\Http\JsonApi\JsonApi;
use Lencse\Application\Http\Messaging\ResponseTransformer;
use Lencse\Application\Routing\Route;
use Lencse\Application\Routing\Router;

class Bootstrap
{

    /**
     * @var Dic
     */
    private $dic;

    /**
     * @var Router
     */
    private $router;

    public function __construct(array $config)
    {
        $this->createDic($config['dic']['class']);
        $this->setupDic($config['dic']);
        $this->createRouter();
        $this->setupRouter($config['routes']);
    }

    public function createApplication(): Application
    {
        return $this->dic->make(Application::class);
    }

    private function createDic(string $dicClass): void
    {
        $this->dic = new $dicClass();
    }

    private function setupDic(array $config): void
    {
        $this->bind($config['bind']);
        $this->injectSelf($config['inject-self']);
        $this->factory($config['factory']);
        $this->share($config['share']);
    }

    private function bind(array $config): void
    {
        foreach ($config as $abstract => $concrete) {
            $this->dic->bind($abstract, $concrete);
        }
    }

    private function factory(array $config): void
    {
        foreach ($config as $abstract => $factory) {
            $this->dic->factory($abstract, $factory);
        }
    }

    private function injectSelf(array $config): void
    {
        foreach ($config as $abstract) {
            $this->dic->shareInstance($abstract, $this->dic);
        }
    }

    private function share(array $config): void
    {
        foreach ($config as $class) {
            $this->dic->share($class);
        }
    }

    private function createRouter(): void
    {
        $this->router = $this->dic->make(Router::class);
    }

    private function setupRouter(array $config): void
    {
        foreach ($config as $path => $handler) {
            $this->router->add(new Route($path, $handler));
        }
    }
}
