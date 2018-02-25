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
     * @return Day[]
     */
    public function getSpecialDaysForYear(int $year): array;
}
