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

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->types);
    }

    public function get(string $key): DayType
    {
        $this->validateKey($key);

        return $this->types[$key];
    }

    private function validateKey(string $key): void
    {
        if (!$this->has($key)) {
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
    public function getAll(): array
    {
        $result = [];
        foreach ($this->types as $type) {
            $result[] = $type;
        }

        return $result;
    }

    /**
     * @return DayType[]
     */
    abstract protected function getTypes(): array;
}
