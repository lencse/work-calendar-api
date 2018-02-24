<?php

namespace Lencse\WorkCalendar\Calendar\Repository;

use DateTimeInterface;
use Lencse\WorkCalendar\Calendar\Day\Day;
use Lencse\WorkCalendar\Calendar\Exception\NoSpecialDayException;

class SpecialDayRepository implements DayRepository
{

    private $days = [];

    public function has(DateTimeInterface $date): bool
    {
        return isset($this->days[$this->format($date)]);
    }

    public function get(DateTimeInterface $date): Day
    {
        $this->validateDate($date);

        return $this->days[$this->format($date)];
    }

    public function add(Day $day)
    {
        $this->days[$this->format($day->getDate())] = $day;
    }

    private function format(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d');
    }

    private function validateDate(DateTimeInterface $date): void
    {
        if (!array_key_exists($this->format($date), $this->days)) {
            throw new NoSpecialDayException(sprintf(
                'No special day for %s',
                $this->format($date)
            ));
        }
    }
}
