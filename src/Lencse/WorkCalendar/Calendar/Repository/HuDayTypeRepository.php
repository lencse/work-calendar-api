<?php

namespace Lencse\WorkCalendar\Calendar\Repository;

use Lencse\WorkCalendar\Calendar\DayType\DayType;
use Lencse\WorkCalendar\Calendar\DayType\DayTypeImp;
use Lencse\WorkCalendar\Calendar\Exception\WrongDayTypeException;

class HuDayTypeRepository implements DayTypeRepository
{

    /**
     * @var DayType[]
     */
    private $types = [];

    public function __construct()
    {
        $typesArr = [
            ['non-working-day', 'Munkaszüneti nap', true, true],
            ['switched-rest-day', 'Áthelyezett pihenőnap', true, true],
            ['switched-working-day', 'Áthelyezett munkanap', false, true],
            ['working-day', 'Munkanap', false, false],
            ['weekend', 'Heti pihenőnap', true, false],
        ];
        foreach ($typesArr as $type) {
            [$key, $name, $rest, $special] = $type;
            $this->types[$key] = new DayTypeImp($key, $name, $rest, $special);
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
}
