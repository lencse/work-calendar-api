<?php

namespace Lencse\WorkCalendar\Calendar;

use Lencse\WorkCalendar\Calendar\Exception\WrongDayType;

class DayType
{

    const NON_WORKING_DAY = 'non-working-day';
    const RELOCATED_REST_DAY = 'relocated-rest-day';
    const RELOCATED_WORKING_DAY = 'relocated-working-day';
    const WORKING_DAY = 'working-day';
    const WEEKEND = 'weekend';

    /**
     * @var string[]
     */
    private static $names = [
        self::NON_WORKING_DAY => 'Munkaszüneti nap',
        self::RELOCATED_REST_DAY => 'Áthelyezett pihenőnap',
        self::RELOCATED_WORKING_DAY => 'Áthelyezett munkanap',
        self::WORKING_DAY => 'Munkanap',
        self::WEEKEND => 'Heti pihenőnap',
    ];

    /**
     * @var string
     */
    private $key;

    public static function get(string $key): self
    {
        self::validateKey($key);
        return new self($key);
    }

    private function __construct(string $key)
    {
        $this->key = $key;
    }

    private static function validateKey(string $key)
    {
        if (!array_key_exists($key, self::$names)) {
            throw new WrongDayType(sprintf(
                'Wrong day type key: %s. Valid day keys are: %s',
                $key,
                implode(', ', array_keys(self::$names))
            ));
        }
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function isRestDay(): bool
    {
        return self::NON_WORKING_DAY === $this->getKey()
            || self::RELOCATED_REST_DAY === $this->getKey()
            || self::WEEKEND === $this->getKey();
    }

    public function getName(): string
    {
        return self::$names[$this->getKey()];
    }

    public function isRegular(): bool
    {
        return self::WORKING_DAY === $this->getKey()
            || self::WEEKEND === $this->getKey();
    }
}
