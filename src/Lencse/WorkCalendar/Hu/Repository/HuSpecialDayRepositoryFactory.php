<?php

namespace Lencse\WorkCalendar\Hu\Repository;

use Lencse\WorkCalendar\Calendar\Repository\SpecialDayRepositoryFactory;

class HuSpecialDayRepositoryFactory extends SpecialDayRepositoryFactory
{

    /**
     * @return string[][]
     */
    protected function getConfig(): array
    {
        return [
            ['2018-01-01', HuDayTypeRepository::NON_WORKING_DAY, 'Újév'],
        ];
    }
}
