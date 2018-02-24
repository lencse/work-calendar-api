<?php

namespace Lencse\WorkCalendar\Calendar\Factory;

use DateTimeInterface;
use Lencse\WorkCalendar\Calendar\Day\Day;
use Lencse\WorkCalendar\Calendar\Day\DayImp;
use Lencse\WorkCalendar\Calendar\Repository\DayTypeRepository;

class DayFactoryImp implements DayFactory
{

    /**
     * @var DayTypeRepository
     */
    private $dayTypeRepo;

    public function __construct(DayTypeRepository $dayTypeRepo)
    {
        $this->dayTypeRepo = $dayTypeRepo;
    }

    public function createDayForDate(DateTimeInterface $date): Day
    {
        return new DayImp($date, $this->dayTypeRepo->getDefaultForDate($date));
    }
}
