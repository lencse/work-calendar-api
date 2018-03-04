<?php

namespace Lencse\WorkCalendar\Calendar\Repository;

use Lencse\WorkCalendar\Calendar\Day\Day;

class SpecialDayRepositoryFactory
{

    /**
     * @var DayTypeRepository
     */
    private $dayTypeRepo;

    /**
     * @var array
     */
    private $buildFromArray;

    public function __construct(DayTypeRepository $dayTypeRepo, array $buildFromArray)
    {
        $this->dayTypeRepo = $dayTypeRepo;
        $this->buildFromArray = $buildFromArray;
    }

    public function createRepository(): DayRepository
    {
        $repo = new SpecialDayRepository();
        foreach ($this->buildFromArray as $config) {
            $date = \DateTimeImmutable::createFromFormat('Y-m-d', $config[0]);
            $type = $this->dayTypeRepo->get($config[1]);
            $description = $config[2];
            $repo->add(new Day($date, $type, $description));
        }

        return $repo;
    }
}
