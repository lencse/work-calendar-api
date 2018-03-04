<?php

namespace Lencse\WorkCalendar\Calendar\DayType;

class DayType
{

    /**
     * @var string
     */
    private $key;

    /**
     * @var bool
     */
    private $restDay;

    /**
     * @var string
     */
    private $name;

    /**
     * @var bool
     */
    private $special;

    public function __construct(string $key, string $name, bool $restDay, bool $special)
    {
        $this->key = $key;
        $this->restDay = $restDay;
        $this->name = $name;
        $this->special = $special;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function isRestDay(): bool
    {
        return $this->restDay;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isSpecial(): bool
    {
        return $this->special;
    }
}
