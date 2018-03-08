<?php

namespace Lencse\WorkCalendar\Hu\Repository;

use Lencse\WorkCalendar\Calendar\Repository\SpecialDayRepositoryFactory;
use Lencse\WorkCalendar\Hu\Repository\HuDayTypeRepository as Hu;

class HuSpecialDayRepositoryFactory extends SpecialDayRepositoryFactory
{

    /**
     * @return string[][]
     */
    protected function getConfig(): array
    {
        return [
            ['2018-01-01', Hu::NON_WORKING_DAY, 'Újév'],
            ['2018-03-10', Hu::SWITCHED_WORKING_DAY, ''],
            ['2018-03-15', Hu::NON_WORKING_DAY, 'Az 1848-as forradalom ünnepe'],
            ['2018-03-16', Hu::SWITCHED_REST_DAY, ''],
            ['2018-03-30', Hu::NON_WORKING_DAY, 'Nagypéntek'],
            ['2018-04-01', Hu::NON_WORKING_DAY, 'Húsvét'],
            ['2018-04-02', Hu::NON_WORKING_DAY, 'Húsvét'],
            ['2018-04-21', Hu::SWITCHED_WORKING_DAY, ''],
            ['2018-05-01', Hu::NON_WORKING_DAY, 'A munka ünnepe'],
            ['2018-05-20', Hu::NON_WORKING_DAY, 'Pünkösd'],
            ['2018-05-21', Hu::NON_WORKING_DAY, 'Pünkösd'],
            ['2018-08-20', Hu::NON_WORKING_DAY, 'Az államalapítás ünnepe'],
            ['2018-10-13', Hu::SWITCHED_WORKING_DAY, ''],
            ['2018-10-22', Hu::SWITCHED_REST_DAY, ''],
            ['2018-10-23', Hu::NON_WORKING_DAY, 'Az 1956-os forradalom ünnepe'],
            ['2018-11-01', Hu::NON_WORKING_DAY, 'Mindenszentek'],
            ['2018-11-02', Hu::SWITCHED_REST_DAY, ''],
            ['2018-12-01', Hu::SWITCHED_WORKING_DAY, ''],
            ['2018-12-15', Hu::SWITCHED_WORKING_DAY, ''],
            ['2018-12-24', Hu::SWITCHED_REST_DAY, ''],
            ['2018-12-25', Hu::NON_WORKING_DAY, 'Karácsony'],
            ['2018-12-26', Hu::NON_WORKING_DAY, 'Karácsony'],
            ['2018-12-31', Hu::SWITCHED_REST_DAY, ''],
        ];
    }
}
