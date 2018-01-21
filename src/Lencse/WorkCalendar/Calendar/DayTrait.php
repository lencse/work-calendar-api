<?php

namespace Lencse\WorkCalendar\Calendar;

use DateTime;

trait DayTrait
{

    /**
     * @var DateTime
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

    public function __construct(DateTime $date, DayType $type, string $description = '')
    {
        $this->date = $date;
        $this->type = $type;
        $this->description = $description;
    }

    public function getDate(): DateTime
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
