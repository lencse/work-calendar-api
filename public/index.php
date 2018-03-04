<?php

namespace App;

use Auryn\Injector;
use Lencse\WorkCalendar\Calendar\Repository\DayTypeRepository;
use Lencse\WorkCalendar\Hu\Repository\HuDayTypeRepository;

require_once __DIR__ . '/../vendor/autoload.php';

$injector = new Injector();

$injector->alias(DayTypeRepository::class, HuDayTypeRepository::class);

$repo = $injector->make(DayTypeRepository::class);

var_dump($repo->getAll());