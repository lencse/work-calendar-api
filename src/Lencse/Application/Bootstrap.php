<?php

namespace Lencse\Application;

use Lencse\Application\DependencyInjection\Caller;
use Lencse\Application\DependencyInjection\Dic;
use Lencse\Application\Http\JsonApi\JsonApi;
use Lencse\Application\Http\Messaging\ResponseTransformer;
use Lencse\Application\Routing\Route;
use Lencse\Application\Routing\Router;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
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

    /**
     * @param array $config
     *
     * @psalm-suppress MixedArrayAccess
     * @psalm-suppress MixedArgument
     */
    public function __construct(array $config)
    {
        $this->createDic((string) $config['dic']['class']);
        $this->setupDic($config['dic']);
        $this->createRouter();
        $this->setupRouter($config['routes']);
    }

    public function createApplication(): Application
    {
        /** @var Application $app */
        $app = $this->dic->make(Application::class);
        return $app;
    }

    private function createDic(string $dicClass): void
    {
        /** @var Dic $dic */
        $dic = new $dicClass();
        $this->dic = $dic;
    }

    /**
     * @param array $config
     *
     * @psalm-suppress MixedArgument
     */
    private function setupDic(array $config): void
    {
        $this->bind($config['bind']);
        $this->injectSelf($config['inject-self']);
        $this->factory($config['factory']);
        $this->share($config['share']);
    }

    /**
     * @param string[] $config
     */
    private function bind(array $config): void
    {
        foreach ($config as $abstract => $concrete) {
            $this->dic->bind((string) $abstract, $concrete);
        }
    }

    /**
     * @param string[] $config
     */
    private function factory(array $config): void
    {
        foreach ($config as $abstract => $factory) {
            $this->dic->factory((string) $abstract, $factory);
        }
    }

    /**
     * @param string[] $config
     */
    private function injectSelf(array $config): void
    {
        foreach ($config as $abstract) {
            $this->dic->shareInstance($abstract, $this->dic);
        }
    }

    /**
     * @param string[] $config
     */
    private function share(array $config): void
    {
        foreach ($config as $class) {
            $this->dic->share($class);
        }
    }

    private function createRouter(): void
    {
        /** @var Router $router */
        $router = $this->dic->make(Router::class);
        $this->router = $router;
    }

    /**
     * @param string[] $config
     */
    private function setupRouter(array $config): void
    {
        foreach ($config as $path => $handler) {
            $this->router->add(new Route((string) $path, $handler));
        }
    }
}
