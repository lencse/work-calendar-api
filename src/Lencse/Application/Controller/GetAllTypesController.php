<?php

namespace Lencse\Application\Controller;

use Lencse\WorkCalendar\Calendar\DayType\Entity\DayType;
use Lencse\WorkCalendar\Calendar\DayType\Repository\DayTypeRepository;

class GetAllTypesController
{

    /**
     * @var DayTypeRepository
     */
    private $dayTypeRepo;

    public function __construct(DayTypeRepository $dayTypeRepo)
    {
        $this->dayTypeRepo = $dayTypeRepo;
    }

    /**
     * @return DayType[]
     */
    public function __invoke(): array
    {
        return $this->dayTypeRepo->getAll();
    }
}
