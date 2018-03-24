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
        $this->validateParams($params);
        $from = DateTimeImmutable::createFromFormat('Y-m-d', (string) $params['from']);
        $to = DateTimeImmutable::createFromFormat('Y-m-d', (string) $params['to']);
        return $this->calendar->getInterval($from, $to);
    }

    /**
     * @param array $params
     * @throws BadRequestException
     */
    private function validateParams(array $params): void
    {
        if (!isset($params['from']) || !isset($params['to'])) {
            $missing = [];
            if (!isset($params['from'])) {
                $missing[] = "'from'";
            }
            if (!isset($params['to'])) {
                $missing[] = "'to'";
            }
            $message = sprintf('Missing parameters: %s', implode(', ', $missing));
            throw new BadRequestException($message);
        }
        foreach (['from', 'to'] as $key) {
            if (!preg_match('/\d{4}-\d{2}-\d{2}/', (string)$params[$key])) {
                $message = sprintf('Invalid date format: %s', $params[$key]);
                throw new BadRequestException($message);
            }
        }
    }
}
