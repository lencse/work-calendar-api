<?php

namespace Test\Unit\Calendar;

use Lencse\Date\DateHelper;
use Lencse\WorkCalendar\Calendar\Repository\SpecialDayRepositoryFactory;
use PHPUnit\Framework\TestCase;
use Test\Unit\Calendar\Mock\MockDayTypeRepository;

class SpecialDayRepositoryFactoryTest extends TestCase
{

    public function testFactory()
    {
        $config = [
            ['2018-03-15', MockDayTypeRepository::NON_WORKING_DAY, 'Description']
        ];
        $factory = new SpecialDayRepositoryFactory(new MockDayTypeRepository(), $config);
        $repo = $factory->createRepository();

        $this->assertEquals('Description', $repo->get(DateHelper::dateTime('2018-03-15'))->getDescription());
    }
}
