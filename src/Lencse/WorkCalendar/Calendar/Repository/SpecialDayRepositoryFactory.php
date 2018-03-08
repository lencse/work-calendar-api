<?php

namespace Lencse\WorkCalendar\Calendar\Repository;

use DateTimeImmutable;
use Lencse\WorkCalendar\Calendar\Day\Day;

abstract class SpecialDayRepositoryFactory
{

    /**
     * @var DayTypeRepository
     */
    private $dayTypeRepo;

    public function __construct(DayTypeRepository $dayTypeRepo)
    {
        $this->dayTypeRepo = $dayTypeRepo;
    }

    public function createRepository(): DayRepository
    {
        $days = [];
        foreach ($this->getConfig() as $config) {
            $date = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $config[0] . ' 00:00:00');
            $type = $this->dayTypeRepo->get($config[1]);
            $description = $config[2];
            $days[] = new Day($date, $type, $description);
        }

        return new InMemoryDayRepository($days);
    }

    /**
     * @return string[][]
     */
    abstract protected function getConfig(): array;
}
