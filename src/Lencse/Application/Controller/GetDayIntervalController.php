<?php

namespace Lencse\Application\Controller;

use DateTimeImmutable;
use Lencse\Application\Exception\BadRequestException;
use Lencse\WorkCalendar\Calendar\Day\Day;
use Lencse\WorkCalendar\Calendar\Repository\Calendar;
use Psr\Http\Message\ServerRequestInterface;

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
     * @param ServerRequestInterface $request
     * @return Day[]
     * @throws BadRequestException
     */
    public function __invoke(ServerRequestInterface $request): array
    {
        $params = $request->getQueryParams();
        if (!isset($params['from']) || !isset($params['to'])) {
            throw new BadRequestException();
        }
        $from = DateTimeImmutable::createFromFormat('Y-m-d', (string) $params['from']);
        $to = DateTimeImmutable::createFromFormat('Y-m-d', (string) $params['to']);
        return $this->calendar->getInterval($from, $to);
    }
}
