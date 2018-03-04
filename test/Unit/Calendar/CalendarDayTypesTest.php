<?php

namespace Test\Unit\Calendar;

use Test\Unit\Calendar\Mock\MockDayTypeRepository;

class CalendarDayTypesTest extends CalendarBaseTest
{

    public function testGetAllTypes()
    {
        $dayTypesRepo = new MockDayTypeRepository();
        $types = $dayTypesRepo->getAll();
        $this->assertCount(3, $types);
    }

    public function testGetType()
    {
        $dayTypesRepo = new MockDayTypeRepository();
        $type = $dayTypesRepo->get(MockDayTypeRepository::WEEKEND);
        $this->assertEquals($this->dayTypeRepo->get(MockDayTypeRepository::WEEKEND), $type);
    }
}
