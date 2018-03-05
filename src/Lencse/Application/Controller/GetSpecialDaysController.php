<?php

namespace Lencse\Application\Controller;

use Lencse\Application\Http\Request;
use Lencse\WorkCalendar\Calendar\Repository\DayRepository;

class GetSpecialDaysController
{

    /**
     * @var DayRepository
     */
    private $dayRepository;

    public function __construct(DayRepository $dayRepository)
    {
        $this->dayRepository = $dayRepository;
    }

    public function __invoke(Request $request)
    {
        if ($request->hasParam('year')) {
            return $this->dayRepository->getForYear((int) $request->getParam('year'));
        }

        return $this->dayRepository->getAll();
    }
}
