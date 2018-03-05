<?php

namespace Lencse\Application\Controller;

use DateTimeImmutable;
use Lencse\WorkCalendar\Calendar\Day\Day;
use Lencse\WorkCalendar\Calendar\Repository\Calendar;

class GetADayController
{

    /**
     * @var Calendar
     */
    private $calendar;

    public function __construct(Calendar $calendar)
    {
        $this->calendar = $calendar;
    }

    public function __invoke(string $day): Day
    {
        $date = DateTimeImmutable::createFromFormat('Y-m-d', $day);
        return $this->calendar->getDay($date);
    }
}
