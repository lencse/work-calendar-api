<?php

namespace Test\Unit\Calendar;

use Lencse\Date\DateHelper;
use Lencse\WorkCalendar\Calendar\Exception\NoSpecialDayException;
use PHPUnit\Framework\TestCase;
use Test\Unit\Calendar\Mock\MockDayRepositoryFactory;
use Test\Unit\Calendar\Mock\MockDayTypeRepository;

class SpecialDayRepositoryFactoryTest extends TestCase
{

    public function testFactory(): void
    {
        $factory = new MockDayRepositoryFactory(new MockDayTypeRepository());
        $repo = $factory->createRepository();

        $this->assertEquals('Description', $repo->get(DateHelper::dateTime('2018-03-15'))->getDescription());
    }


    public function testArgument(): void
    {
        $factory = new MockDayRepositoryFactory(new MockDayTypeRepository());
        $repo = $factory->createRepository();
        $this->expectException(NoSpecialDayException::class);
        $repo->get(DateHelper::dateTime('2018-03-18'));
    }
}
