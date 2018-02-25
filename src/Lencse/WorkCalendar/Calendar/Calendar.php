<?php

namespace Lencse\WorkCalendar\Calendar;

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

    /**
     * @return Day[]
     */
    public function getAllSpecialDays(): array;

    /**
     * @param int $year
     * @return Day[]
     */
    public function getSpecialDaysForYear(int $year): array;

    /**
     * @return DayType[]
     */
    public function getAllTypes(): array;
}
