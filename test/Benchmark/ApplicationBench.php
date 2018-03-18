<?php

namespace Test\Benchmark;

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

    public function benchDayTypes()
    {
        $this->app->callDayTypesRoute();
    }

    public function benchDayType()
    {
        $this->app->callDayTypeRoute();
    }

    public function benchSpecialDaysForAYear()
    {
        $this->app->callSpecialDaysForAYearRoute();
    }

    public function benchSpecialDays()
    {
        $this->app->callSpecialDaysRoute();
    }

    public function benchADay()
    {
        $this->app->callADayRoute();
    }

    public function benchDayInterval()
    {
        $this->app->callDayIntervalRoute('2018-01-01', '2018-12-31');
    }
}
