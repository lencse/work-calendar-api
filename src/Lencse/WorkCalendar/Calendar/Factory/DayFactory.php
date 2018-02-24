<?php

namespace Lencse\WorkCalendar\Calendar\Factory;

use DateTimeInterface;
use Lencse\WorkCalendar\Calendar\Day\Day;

interface DayFactory
{

    public function createDayForDate(DateTimeInterface $date): Day;
}
