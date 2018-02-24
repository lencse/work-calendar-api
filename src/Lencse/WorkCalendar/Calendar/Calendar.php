<?php

namespace Lencse\WorkCalendar\Calendar;

use DateTimeInterface;
use Lencse\WorkCalendar\Calendar\Day\Day;

interface Calendar
{

    public function createDayForDate(DateTimeInterface $date): Day;
}
