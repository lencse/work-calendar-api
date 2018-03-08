<?php

namespace Lencse\Application\Controller;

use DateTimeImmutable;
use Lencse\Application\Exception\BadRequestException;
use Lencse\Application\Http\Request;
use Lencse\WorkCalendar\Calendar\Day\Day;
use Lencse\WorkCalendar\Calendar\Repository\Calendar;

class GetDayIntervalController
{

    /**
     * @var Calendar
     */
    private $calendar;

    public function __construct(Calendar $calendar)
    {
        $this->calendar = $calendar;
    }

    /**
     * @param Request $request
     * @return Day[]
     */
    public function __invoke(Request $request): array
    {
        if (!$request->hasParam('to') || !$request->hasParam('from')) {
            throw new BadRequestException();
        }
        $from = DateTimeImmutable::createFromFormat('Y-m-d', (string) $request->getParam('from'));
        $to = DateTimeImmutable::createFromFormat('Y-m-d', (string) $request->getParam('to'));
        return $this->calendar->getInterval($from, $to);
    }
}
