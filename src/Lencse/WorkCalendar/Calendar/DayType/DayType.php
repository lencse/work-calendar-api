<?php

namespace Lencse\WorkCalendar\Calendar\DayType;

interface DayType
{

    public function getKey(): string;

    public function isRestDay(): bool;

    public function getName(): string;

    public function isSpecial(): bool;
}
