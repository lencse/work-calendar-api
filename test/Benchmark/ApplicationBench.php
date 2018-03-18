<?php

namespace Test\Benchmark;

use GuzzleHttp\Psr7\ServerRequest;
use Lencse\Application\Bootstrap;
use Test\Integration\ApplicationRunner;

class ApplicationBench
{

    /**
     * @var ApplicationRunner
     */
    private $app;

    public function __construct()
    {
        $this->app = new ApplicationRunner();
    }

    public function benchDayTypesRoute()
    {
        $this->app->callDayTypesRoute();
    }

    public function benchDayTypeRoute()
    {
        $this->app->callDayTypeRoute();
    }

    public function benchSpecialDaysForAYearRoute()
    {
        $this->app->callSpecialDaysForAYearRoute();
    }

    public function benchSpecialDaysRoute()
    {
        $this->app->callSpecialDaysRoute();
    }

    public function benchADayRoute()
    {
        $this->app->callADayRoute();
    }

    public function benchDayIntervalRoute()
    {
        $this->app->callDayIntervalRoute('2018-01-01', '2018-12-31');
    }
}
