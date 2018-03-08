<?php

namespace Lencse\Date;

use DateTimeImmutable;
use Lencse\Date\Exception\WrongDateFormatException;

class DateHelper
{

    public static function dateTime(string $dateString): \DateTimeInterface
    {
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateString)) {
            return DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $dateString . ' 00:00:00');
        }
        if (preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $dateString)) {
            return DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $dateString);
        }

        throw new WrongDateFormatException(sprintf('Invalid date format: %s', $dateString));
    }
}
