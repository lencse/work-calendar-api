<?php

namespace Lencse\WorkCalendar\Calendar\Repository;

use DateTimeInterface;
use Lencse\WorkCalendar\Calendar\Day\Day;
use Lencse\WorkCalendar\Calendar\DayType\DayType;

interface Calendar
{

    public function getDay(DateTimeInterface $date): Day;

    /**
     * @param DateTimeInterface $startDate
     * @param DateTimeInterface $endDate
     * @return Day[]
     */
    public function getInterval(DateTimeInterface $startDate, DateTimeInterface $endDate): array;

    /**
     * @param int $year
     * @return Day[]
     */
    public function getYear(int $year): array;
}
