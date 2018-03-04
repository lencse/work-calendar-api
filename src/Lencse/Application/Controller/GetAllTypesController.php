<?php

namespace Lencse\Application\Controller;

use Lencse\WorkCalendar\Calendar\Calendar;

class GetAllTypesController
{

    /**
     * @var Calendar
     */
    private $calendar;

    public function __construct(Calendar $calendar)
    {
        $this->calendar = $calendar;
    }

    public function __invoke(): array
    {
        return $this->calendar->getAllTypes();
    }
}
