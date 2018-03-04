<?php

namespace Lencse\WorkCalendar\Calendar\Day;

use DateTimeInterface;
use Lencse\WorkCalendar\Calendar\DayType\DayType;

class Day
{

    /**
     * @var DateTimeInterface
     */
    private $date;

    /**
     * @var DayType
     */
    private $type;

    /**
     * @var string
     */
    private $description;

    public function __construct(DateTimeInterface $date, DayType $type, string $description = '')
    {
        $this->date = $date;
        $this->type = $type;
        $this->description = $description;
    }

    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    public function getType(): DayType
    {
        return $this->type;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
