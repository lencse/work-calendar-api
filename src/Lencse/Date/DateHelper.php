<?php

namespace Lencse\Date;

use DateTime;
use Lencse\Date\Exception\WrongDateFormatException;

class DateHelper
{

    private static $regexpToFormat = [
        '/^\d{4}-\d{2}-\d{2}$/' => 'Y-m-d',
        '/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/' => 'Y-m-d H:i:s',
    ];

    public static function dateTime(string $dateString): DateTime
    {
        foreach (self::$regexpToFormat as $regexp => $format) {
            if (preg_match($regexp, $dateString)) {
                return DateTime::createFromFormat($format, $dateString);
            }
        }

        throw new WrongDateFormatException(sprintf('Invalid date format: %s', $dateString));
    }
}
