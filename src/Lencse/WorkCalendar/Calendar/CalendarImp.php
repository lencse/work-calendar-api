<?php

namespace Lencse\WorkCalendar\Calendar;

use DateTime;
use DateTimeInterface;
use DateTimeImmutable;
use Lencse\WorkCalendar\Calendar\Day\Day;
use Lencse\WorkCalendar\Calendar\Day\DayImp;
use Lencse\WorkCalendar\Calendar\Repository\DayRepository;
use Lencse\WorkCalendar\Calendar\Repository\DayTypeRepository;

class CalendarImp implements Calendar
{

    /**
     * @var DayTypeRepository
     */
    private $dayTypeRepo;

    /**
     * @var DayRepository
     */
    private $dayRepo;

    public function __construct(DayTypeRepository $dayTypeRepo, DayRepository $dayRepo)
    {
        $this->dayTypeRepo = $dayTypeRepo;
        $this->dayRepo = $dayRepo;
    }

    public function getDay(DateTimeInterface $date): Day
    {
        if ($this->dayRepo->has($date)) {
            return $this->dayRepo->get($date);
        }

        return new DayImp($date, $this->dayTypeRepo->getDefaultForDate($date));
    }

    /**
     * @param DateTimeInterface $startDate
     * @param DateTimeInterface $endDate
     * @return Day[]
     */
    public function getInterval(DateTimeInterface $startDate, DateTimeInterface $endDate): array
    {
        $result = [];
        $day = DateTime::createFromFormat('Y-m-d', $startDate->format('Y-m-d'));
        while ($day->getTimestamp() <= $endDate->getTimestamp()) {
            $result[] = $this->getDay(clone $day);
            $day = $day->add(new \DateInterval('P1D'));
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
            DateTimeImmutable::createFromFormat('Y-m-d', sprintf('%s-01-01', $year)),
            DateTimeImmutable::createFromFormat('Y-m-d', sprintf('%s-12-31', $year))
        );
    }
}
