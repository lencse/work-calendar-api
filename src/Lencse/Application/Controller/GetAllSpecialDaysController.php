<?php

namespace Lencse\Application\Controller;

use Lencse\WorkCalendar\Calendar\Repository\DayRepository;

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

    public function __invoke()
    {
        return $this->dayRepository->getAll();
    }
}
