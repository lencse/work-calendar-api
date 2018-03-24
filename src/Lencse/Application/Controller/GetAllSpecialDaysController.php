<?php

namespace Lencse\Application\Controller;

use Lencse\WorkCalendar\Calendar\Day\Entity\Day;
use Lencse\WorkCalendar\Calendar\Day\Repository\DayRepository;

class GetAllSpecialDaysController
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
     * @return Day[]
     */
    public function __invoke(): array
    {
        return $this->dayRepository->getAll();
    }
}
