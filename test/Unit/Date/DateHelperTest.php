<?php

namespace Test\Unit\Date;

use Lencse\Date\DateHelper;
use Lencse\Date\Exception\WrongDateFormatException;
use PHPUnit\Framework\TestCase;
use DateTime;

class DateHelperTest extends TestCase
{

    public function testDateTime()
    {
        $this->assertEquals(
            DateTime::createFromFormat('Y-m-d', '2017-03-15'),
            DateHelper::dateTime('2017-03-15')
        );
        $this->assertEquals(
            DateTime::createFromFormat('Y-m-d H:i:s', '2017-03-15 10:15:00'),
            DateHelper::dateTime('2017-03-15 10:15:00')
        );
    }

    public function testWrongFormat()
    {
        $this->expectException(WrongDateFormatException::class);
        DateHelper::dateTime('2017-03-15 10-15-00');
    }
}
