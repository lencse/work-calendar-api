<?php

namespace Lencse\WorkCalendar\Calendar\Repository;

use Lencse\WorkCalendar\Calendar\DayType\DayType;
use Lencse\WorkCalendar\Calendar\Exception\WrongDayTypeException;

abstract class InMemoryDayTypeRepository implements DayTypeRepository
{

    /**
     * @var DayType[]
     */
    private $types = [];

    public function __construct()
    {
        foreach ($this->getTypes() as $type) {
            $this->types[$type->getKey()] = $type;
        }
    }

    public function get(string $key): DayType
    {
        $this->validateKey($key);

        return $this->types[$key];
    }

    private function validateKey(string $key): void
    {
        if (!array_key_exists($key, $this->types)) {
            throw new WrongDayTypeException(sprintf(
                'Wrong day type key: %s. Valid day keys are: %s',
                $key,
                implode(', ', array_keys($this->types))
            ));
        }
    }

    /**
     * @return DayType[]
     */
    abstract protected function getTypes(): array;
}
