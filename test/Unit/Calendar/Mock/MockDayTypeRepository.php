<?php

namespace Test\Unit\Calendar\Mock;

use DateTimeInterface;
use Lencse\WorkCalendar\Calendar\DayType\DayType;
use Lencse\WorkCalendar\Calendar\Repository\InMemoryDayTypeRepository;

class MockDayTypeRepository extends InMemoryDayTypeRepository
{

    const WORKING_DAY = 'working-day';
    const WEEKEND = 'weekend';
    const NON_WORKING_DAY = 'non-working-day';

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
