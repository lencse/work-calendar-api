<?php

namespace Lencse\WorkCalendar\Calendar;

use DateTimeInterface;
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
}
