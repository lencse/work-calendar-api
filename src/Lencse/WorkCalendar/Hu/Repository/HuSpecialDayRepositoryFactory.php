<?php

namespace Lencse\WorkCalendar\Hu\Repository;

use Lencse\WorkCalendar\Calendar\Repository\SpecialDayRepositoryFactory;

class HuSpecialDayRepositoryFactory extends SpecialDayRepositoryFactory
{

    /**
     * @return string[][]
     */
    protected function getConfig(): array
    {
        /** @var string[][] $result */
        $result = require __DIR__ . '/data.php';

        return $result;
    }
}
