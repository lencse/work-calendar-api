<?php

namespace Lencse\WorkCalendar\Calendar;

use DateTimeInterface;
use Lencse\WorkCalendar\Calendar\Day\Day;

interface Calendar
{

    public function getDay(DateTimeInterface $date): Day;

    /**
     * @param DateTimeInterface $startDate
     * @param DateTimeInterface $endDate
     * @return Day[]
     */
    public function getInterval(DateTimeInterface $startDate, DateTimeInterface $endDate): array;
}
