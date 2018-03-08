<?php

namespace Test\Unit\Calendar\Mock;

use Lencse\WorkCalendar\Calendar\Repository\SpecialDayRepositoryFactory;

class MockDayRepositoryFactory extends SpecialDayRepositoryFactory
{

    /**
     * @return string[][]
     */
    protected function getConfig(): array
    {
        return [
            ['2018-03-15', MockDayTypeRepository::NON_WORKING_DAY, 'Description'],
            ['2015-03-15', MockDayTypeRepository::NON_WORKING_DAY, 'Description'],
            ['2015-10-23', MockDayTypeRepository::NON_WORKING_DAY, 'Description'],
        ];
    }
}
