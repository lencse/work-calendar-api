<?php

namespace App;

use Auryn\Injector;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
use GuzzleHttp\Psr7\Request;
use Lencse\Application\Controller\GetAllTypesController;
use Lencse\WorkCalendar\Calendar\Repository\DayTypeRepository;
use Lencse\WorkCalendar\Hu\Repository\HuDayTypeRepository;

require_once __DIR__ . '/../vendor/autoload.php';

$injector = new Injector();

$injector->alias(DayTypeRepository::class, HuDayTypeRepository::class);

$repo = $injector->make(DayTypeRepository::class);

//var_dump($repo->getAll());

$dispatcher = simpleDispatcher(function (RouteCollector $routes) {
    $routes->addRoute('GET', '/api/v1/day-types', GetAllTypesController::class);
});

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

$routeInfo = $dispatcher->dispatch($method, $uri);
var_dump($routeInfo);

//$request = new Request();