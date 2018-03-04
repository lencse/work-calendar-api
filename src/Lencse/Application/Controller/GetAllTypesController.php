<?php

namespace Lencse\Application\Controller;

use Lencse\WorkCalendar\Calendar\Repository\DayTypeRepository;

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

    public function __invoke(): array
    {
        return $this->dayTypeRepo->getAll();
    }
}
