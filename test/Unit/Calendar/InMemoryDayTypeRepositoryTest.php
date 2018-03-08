<?php

namespace Test\Unit\Calendar;

use Lencse\Date\DateHelper;
use Lencse\WorkCalendar\Calendar\Exception\WrongDayTypeException;
use Lencse\WorkCalendar\Calendar\Repository\DayTypeRepository;
use PHPUnit\Framework\TestCase;
use Test\Unit\Calendar\Mock\MockDayTypeRepository;

class InMemoryDayTypeRepositoryTest extends TestCase
{

    /**
     * @var DayTypeRepository
     */
    private $repo;

    protected function setUp(): void
    {
        $this->repo = new MockDayTypeRepository();
    }

    public function testGet(): void
    {
        $this->dayTypeEquals('non-working-day', 'Munkaszüneti nap', true, true);
        $this->dayTypeEquals('working-day', 'Munkanap', false, false);
        $this->dayTypeEquals('weekend', 'Heti pihenőnap', true, false);
    }

    public function testArgument(): void
    {
        $this->expectException(WrongDayTypeException::class);
        $this->repo->get('invalid');
    }

    public function testDefaultForDate(): void
    {
        $type = $this->repo->getDefaultForDate(DateHelper::dateTime('2018-02-24'));
        $this->assertEquals(MockDayTypeRepository::WEEKEND, $type->getKey());
    }

    private function dayTypeEquals(string $key, string $name, bool $rest, bool $special)
    {
        $dayType = $this->repo->get($key);
        $this->assertEquals($key, $dayType->getKey());
        $this->assertEquals($name, $dayType->getName());
        $this->assertEquals($rest, $dayType->isRestDay());
        $this->assertEquals($special, $dayType->isSpecial());
    }
}
