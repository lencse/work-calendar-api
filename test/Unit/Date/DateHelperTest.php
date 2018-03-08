<?php

namespace Test\Unit\Date;

use Lencse\Date\DateHelper;
use Lencse\Date\Exception\WrongDateFormatException;
use PHPUnit\Framework\TestCase;
use DateTimeImmutable;

class DateHelperTest extends TestCase
{

    public function testDateTime(): void
    {
        $this->assertEquals(
            DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2017-03-15 00:00:00'),
            DateHelper::dateTime('2017-03-15')
        );
        $this->assertEquals(
            DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2017-03-15 10:15:00'),
            DateHelper::dateTime('2017-03-15 10:15:00')
        );
    }

    public function testWrongFormat(): void
    {
        $this->expectException(WrongDateFormatException::class);
        DateHelper::dateTime('2017-03-15 10-15-00');
    }
}
