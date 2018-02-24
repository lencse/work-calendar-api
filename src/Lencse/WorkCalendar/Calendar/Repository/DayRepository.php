<?php

namespace Lencse\WorkCalendar\Calendar\Repository;

use DateTimeInterface;
use Lencse\WorkCalendar\Calendar\Day\Day;

interface DayRepository
{

    public function has(DateTimeInterface $date): bool;

    public function get(DateTimeInterface $date): Day;
}
