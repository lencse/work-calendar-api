<?php

namespace Lencse\WorkCalendar\Calendar\Repository;

use DateTimeInterface;
use Lencse\WorkCalendar\Calendar\DayType\DayType;
use Lencse\WorkCalendar\Calendar\DayType\DayTypeImp;
use Lencse\WorkCalendar\Calendar\Exception\WrongDayTypeException;

class HuDayTypeRepository implements DayTypeRepository
{
    const NON_WORKING_DAY = 'non-working-day';
    const SWITCHED_REST_DAY = 'switched-rest-day';
    const SWITCHED_WORKING_DAY = 'switched-working-day';
    const WORKING_DAY = 'working-day';
    const WEEKEND = 'weekend';

    /**
     * @var DayType[]
     */
    private $types = [];

    public function __construct()
    {
        $typesArr = [
            [self::NON_WORKING_DAY, 'Munkaszüneti nap', true, true],
            [self::SWITCHED_REST_DAY, 'Áthelyezett pihenőnap', true, true],
            [self::SWITCHED_WORKING_DAY, 'Áthelyezett munkanap', false, true],
            [self::WORKING_DAY, 'Munkanap', false, false],
            [self::WEEKEND, 'Heti pihenőnap', true, false],
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

    public function getDefaultForDate(DateTimeInterface $date): DayType
    {
        $dayOfWeek = (int) $date->format('N');

        return 6 === $dayOfWeek || 7 === $dayOfWeek
            ? $this->get(self::WEEKEND)
            : $this->get(self::WORKING_DAY);
    }
}
