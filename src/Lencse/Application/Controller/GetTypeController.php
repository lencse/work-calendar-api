<?php

namespace Lencse\Application\Controller;

use Lencse\Application\Exception\NotFoundException;
use Lencse\WorkCalendar\Calendar\DayType\DayType;
use Lencse\WorkCalendar\Calendar\Repository\DayTypeRepository;

class GetTypeController
{

    /**
     * @var DayTypeRepository
     */
    private $dayTypeRepo;

    public function __construct(DayTypeRepository $dayTypeRepo)
    {
        $this->dayTypeRepo = $dayTypeRepo;
    }

    public function __invoke(string $key): DayType
    {
        if (!$this->dayTypeRepo->has($key)) {
            throw new NotFoundException();
        }

        return $this->dayTypeRepo->get($key);
    }
}
