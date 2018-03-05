<?php

namespace Lencse\Application\Controller;

use Lencse\Application\Http\Request;
use Lencse\WorkCalendar\Calendar\Repository\DayRepository;

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

    public function __invoke(int $year): array
    {
        return $this->dayRepository->getForYear($year);
    }
}
