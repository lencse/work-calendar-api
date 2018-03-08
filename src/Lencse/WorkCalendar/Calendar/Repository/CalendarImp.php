<?php

namespace Lencse\WorkCalendar\Calendar\Repository;

use DateInterval;
use DateTime;
use DateTimeInterface;
use DateTimeImmutable;
use Lencse\WorkCalendar\Calendar\Day\Day;

class CalendarImp implements Calendar
{

    /**
     * @var DayTypeRepository
     */
    private $dayTypeRepo;

    /**
     * @var DayRepository
     */
    private $specialDayRepo;

    public function __construct(DayTypeRepository $dayTypeRepo, DayRepository $specialDayRepo)
    {
        $this->dayTypeRepo = $dayTypeRepo;
        $this->specialDayRepo = $specialDayRepo;
    }

    public function getDay(DateTimeInterface $date): Day
    {
        if ($this->specialDayRepo->has($date)) {
            return $this->specialDayRepo->get($date);
        }

        return new Day($date, $this->dayTypeRepo->getDefaultForDate($date));
    }

    /**
     * @param DateTimeInterface $startDate
     * @param DateTimeInterface $endDate
     * @return Day[]
     */
    public function getInterval(DateTimeInterface $startDate, DateTimeInterface $endDate): array
    {
        $result = [];
        /** @var DateTime $day */
        $day = DateTime::createFromFormat('Y-m-d H:i:s', $startDate->format('Y-m-d') . ' 00:00:00');
        while ($day->getTimestamp() <= $endDate->getTimestamp()) {
            $result[] = $this->getDay(clone $day);
            $day = $day->add(new DateInterval('P1D'));
        }

        return $result;
    }

    /**
     * @param int $year
     * @return Day[]
     */
    public function getYear(int $year): array
    {
        return $this->getInterval(
            DateTimeImmutable::createFromFormat('Y-m-d H:i:s', sprintf('%s-01-01 00:00:00', $year)),
            DateTimeImmutable::createFromFormat('Y-m-d H:i:s', sprintf('%s-12-31 00:00:00', $year))
        );
    }
}
