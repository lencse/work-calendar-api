<?php

namespace Test\Unit\Calendar;

use Lencse\Date\DateHelper;
use Lencse\WorkCalendar\Calendar\Day\Day;
use Lencse\WorkCalendar\Calendar\DayType\DayType;
use Lencse\WorkCalendar\Calendar\Exception\NoSpecialDayException;
use Lencse\WorkCalendar\Calendar\Repository\DayRepository;
use Lencse\WorkCalendar\Calendar\Repository\SpecialDayRepository;
use PHPUnit\Framework\TestCase;

class SpecialDayRepositoryTest extends TestCase
{

    /**
     * @var DayRepository
     */
    private $repo;

    protected function setUp()
    {
        $this->repo = new SpecialDayRepository();
        $this->repo->add(
            new Day(
                DateHelper::dateTime('2018-03-15'),
                new DayType('key', 'name', false, false)
            )
        );
    }

    public function testHas()
    {
        $this->assertFalse($this->repo->has(DateHelper::dateTime('2018-02-24')));
        $this->assertTrue($this->repo->has(DateHelper::dateTime('2018-03-15')));
    }

    public function testGet()
    {
        $day = $this->repo->get(DateHelper::dateTime('2018-03-15'));
        $this->assertEquals(DateHelper::dateTime('2018-03-15'), $day->getDate());
        $this->assertEquals('key', $day->getType()->getKey());
    }

    public function testArgument()
    {
        $this->expectException(NoSpecialDayException::class);
        $this->repo->get(DateHelper::dateTime('2018-02-24'));
    }
}
