<?php

namespace Test\Unit\Calendar;

use Lencse\WorkCalendar\Calendar\Exception\WrongDayTypeException;
use Lencse\WorkCalendar\Calendar\Repository\DayTypeRepository;
use Lencse\WorkCalendar\Calendar\Repository\HuDayTypeRepository;
use PHPUnit\Framework\TestCase;

class DayTypeRepositoryTest extends TestCase
{

    /**
     * @var DayTypeRepository
     */
    private $repo;

    protected function setUp()
    {
        $this->repo = new HuDayTypeRepository();
    }


    public function testGet()
    {
        $this->dayTypeEquals('non-working-day', 'Munkaszüneti nap', true, true);
        $this->dayTypeEquals('switched-rest-day', 'Áthelyezett pihenőnap', true, true);
        $this->dayTypeEquals('switched-working-day', 'Áthelyezett munkanap', false, true);
        $this->dayTypeEquals('working-day', 'Munkanap', false, false);
        $this->dayTypeEquals('weekend', 'Heti pihenőnap', true, false);
    }

    public function testArgument()
    {
        $this->expectException(WrongDayTypeException::class);
        $this->repo->get('invalid');
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
