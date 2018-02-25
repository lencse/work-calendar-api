<?php

namespace Lencse\WorkCalendar\Calendar\Repository;

use DateTimeInterface;
use Lencse\WorkCalendar\Calendar\DayType\DayType;

interface DayTypeRepository
{

    public function get(string $key): DayType;

    public function getDefaultForDate(DateTimeInterface $date): DayType;

    /**
     * @return DayType[]
     */
    public function getAll(): array;
}
