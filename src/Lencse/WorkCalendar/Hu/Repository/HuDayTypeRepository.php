<?php

namespace Lencse\WorkCalendar\Hu\Repository;

use DateTimeInterface;
use Lencse\WorkCalendar\Calendar\DayType\DayType;
use Lencse\WorkCalendar\Calendar\Repository\InMemoryDayTypeRepository;

class HuDayTypeRepository extends InMemoryDayTypeRepository
{
    const NON_WORKING_DAY = 'non-working-day';
    const SWITCHED_REST_DAY = 'switched-rest-day';
    const SWITCHED_WORKING_DAY = 'switched-working-day';
    const WORKING_DAY = 'working-day';
    const WEEKEND = 'weekend';

    public function getDefaultForDate(DateTimeInterface $date): DayType
    {
        $dayOfWeek = (int) $date->format('N');

        return 6 === $dayOfWeek || 7 === $dayOfWeek
            ? $this->get(self::WEEKEND)
            : $this->get(self::WORKING_DAY);
    }

    protected function getTypes(): array
    {
        $typesArr = [
            [self::NON_WORKING_DAY, 'Munkaszüneti nap', true, true],
            [self::SWITCHED_REST_DAY, 'Áthelyezett pihenőnap', true, true],
            [self::SWITCHED_WORKING_DAY, 'Áthelyezett munkanap', false, true],
            [self::WORKING_DAY, 'Munkanap', false, false],
            [self::WEEKEND, 'Heti pihenőnap', true, false],
        ];
        $result = [];
        foreach ($typesArr as $type) {
            [$key, $name, $rest, $special] = $type;
            $result[$key] = new DayType($key, $name, $rest, $special);
        }

        return $result;
    }
}
