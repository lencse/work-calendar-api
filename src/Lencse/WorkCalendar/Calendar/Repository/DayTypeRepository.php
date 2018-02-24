<?php

namespace Lencse\WorkCalendar\Calendar\Repository;

use Lencse\WorkCalendar\Calendar\DayType\DayType;

interface DayTypeRepository
{

    public function get(string $key): DayType;
}
