<?php

namespace Lencse\WorkCalendar\Calendar\Day;

use DateTimeInterface;
use Lencse\WorkCalendar\Calendar\DayType\DayType;

interface Day
{

    public function getDate(): DateTimeInterface;

    public function getType(): DayType;

    public function getDescription(): string;
}
