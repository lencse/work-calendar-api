<?php

namespace Config;

use Dotenv\Dotenv;
use Lencse\Adapter\DependencyInjection\AurynDic;
use Lencse\Adapter\Http\JsonApi\NeomerxJsonApi;
use Lencse\Adapter\Http\Messaging\GuzzleHttpResponseTransformer;
use Lencse\Adapter\Routing\FastrouteRouter;
use Lencse\Application\Controller\GetADayController;
use Lencse\Application\Controller\GetAllSpecialDaysController;
use Lencse\Application\Controller\GetAllTypesController;
use Lencse\Application\Controller\GetDayIntervalController;
use Lencse\Application\Controller\GetSpecialDaysForYearController;
use Lencse\Application\Controller\GetTypeController;
use Lencse\Application\DependencyInjection\Caller;
use Lencse\Application\Http\JsonApi\JsonApi;
use Lencse\Application\Http\Messaging\ResponseTransformer;
use Lencse\Application\Routing\Router;
use Lencse\WorkCalendar\Calendar\Repository\DayRepository;
use Lencse\WorkCalendar\Calendar\Repository\DayTypeRepository;
use Lencse\WorkCalendar\Hu\Repository\HuDayTypeRepository;
use Lencse\WorkCalendar\Hu\Repository\HuSpecialDayRepositoryFactory;

$appRoot = __DIR__ . '/../';

if (file_exists($appRoot . '.env')) {
    var_dump(1111);
    $dotenv = new Dotenv($appRoot);
    $dotenv->load();
}

return [
    'dic' => [
        'class' => AurynDic::class,
        'inject-self' => [
            Caller::class,
        ],
        'bind' => [
            DayTypeRepository::class => HuDayTypeRepository::class,
            JsonApi::class => NeomerxJsonApi::class,
            ResponseTransformer::class => GuzzleHttpResponseTransformer::class,
            Router::class => FastrouteRouter::class,
        ],
        'factory' => [
            DayRepository::class => HuSpecialDayRepositoryFactory::class,
        ],
        'share' => [
            Router::class,
        ],
    ],
    'routes' => [
        '/api/v1/day-types' => GetAllTypesController::class,
        '/api/v1/day-types/{key:[a-z-]+}' => GetTypeController::class,
        '/api/v1/days/special' => GetAllSpecialDaysController::class,
        '/api/v1/days/special/{year:\d{4}}' => GetSpecialDaysForYearController::class,
        '/api/v1/days/{day:\d{4}-\d{2}-\d{2}}' => GetADayController::class,
        '/api/v1/days' => GetDayIntervalController::class,
    ],
    'sentry' => [
        'dsn' => getenv('SENTRY_DSN'),
        'config' => [
            'environment' => getenv('SENTRY_ENVIRONMENT'),
        ],
    ]
];
