<?php

namespace Lencse\WorkCalendar\Calendar;

use DateTimeInterface;
use Lencse\WorkCalendar\Calendar\Day\Day;

interface Calendar
{

    public function getDay(DateTimeInterface $date): Day;
}
