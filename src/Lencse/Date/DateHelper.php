<?php

namespace Lencse\Date;

use DateTimeImmutable;
use Lencse\Date\Exception\WrongDateFormatException;

class DateHelper
{

    private static $regexpToFormat = [
        '/^\d{4}-\d{2}-\d{2}$/' => 'Y-m-d',
        '/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/' => 'Y-m-d H:i:s',
    ];

    public static function dateTime(string $dateString): \DateTimeInterface
    {
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateString)) {
            return DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $dateString . ' 00:00:00');
        }
        foreach (self::$regexpToFormat as $regexp => $format) {
            if (preg_match($regexp, $dateString)) {
                return DateTimeImmutable::createFromFormat($format, $dateString);
            }
        }

        throw new WrongDateFormatException(sprintf('Invalid date format: %s', $dateString));
    }
}
