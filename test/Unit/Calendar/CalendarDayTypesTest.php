<?php

namespace Test\Unit\Calendar;

use Test\Unit\Calendar\Mock\MockDayTypeRepository;

class CalendarDayTypesTest extends CalendarBaseTest
{

    public function testGetAllTypes()
    {
//        !da
        $types = $this->calendar->getAllTypes();
        $this->assertCount(3, $types);
    }

    public function testGetType()
    {
        $type = $this->calendar->getDayType(MockDayTypeRepository::WEEKEND);
        $this->assertEquals($this->dayTypeRepo->get(MockDayTypeRepository::WEEKEND), $type);
    }
}
