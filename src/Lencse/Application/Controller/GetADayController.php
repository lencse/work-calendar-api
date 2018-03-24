<?php

namespace Lencse\Application\Controller;

use DateTimeImmutable;
use Lencse\WorkCalendar\Calendar\Day\Entity\Day;
use Lencse\WorkCalendar\Calendar\Calendar;

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
        $date = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $day . ' 00:00:00');
        return $this->calendar->getDay($date);
    }
}
