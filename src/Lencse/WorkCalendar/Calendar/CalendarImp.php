<?php

namespace Lencse\WorkCalendar\Calendar;

use DateTime;
use DateTimeInterface;
use DateTimeImmutable;
use Lencse\WorkCalendar\Calendar\Day\Day;
use Lencse\WorkCalendar\Calendar\Day\DayImp;
use Lencse\WorkCalendar\Calendar\DayType\DayType;
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
        $day = DateTime::createFromFormat('Y-m-d H:i:s', $startDate->format('Y-m-d'). ' 00:00:00');
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
            DateTimeImmutable::createFromFormat('Y-m-d H:i:s', sprintf('%s-01-01 00:00:00', $year)),
            DateTimeImmutable::createFromFormat('Y-m-d H:i:s', sprintf('%s-12-31 00:00:00', $year))
        );
    }

    /**
     * @return Day[]
     */
    public function getAllSpecialDays(): array
    {
        return $this->dayRepo->getAll();
    }

    /**
     * @return Day[]
     */
    public function getSpecialDaysForYear(int $year): array
    {
        return $this->dayRepo->getForYear($year);
    }

    /**
     * @return DayType[]
     */
    public function getAllTypes(): array
    {
        return $this->dayTypeRepo->getAll();
    }
}
