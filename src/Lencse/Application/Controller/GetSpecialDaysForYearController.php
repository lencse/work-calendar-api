<?php

namespace Lencse\Application\Controller;

use Lencse\WorkCalendar\Calendar\Day\Entity\Day;
use Lencse\WorkCalendar\Calendar\Day\Repository\DayRepository;

class GetSpecialDaysForYearController
{

    /**
     * @var DayRepository
     */
    private $dayRepository;

    public function __construct(DayRepository $dayRepository)
    {
        $this->dayRepository = $dayRepository;
    }

    /**
     * @param int $year
     * @return Day[]
     */
    public function __invoke(int $year): array
    {
        return $this->dayRepository->getForYear($year);
    }
}
