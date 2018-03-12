<?php

namespace Lencse\WorkCalendar\Calendar\Repository;

use DateTimeInterface;
use Lencse\WorkCalendar\Calendar\Day\Day;
use Lencse\WorkCalendar\Calendar\Exception\NoSpecialDayException;

class InMemoryDayRepository implements DayRepository
{

    /**
     * @var Day[]
     */
    private $days = [];

    /**
     * @param Day[] $days
     */
    public function __construct(array $days)
    {
        foreach ($days as $day) {
            $this->add($day);
        }
    }

    public function has(DateTimeInterface $date): bool
    {
        return isset($this->days[$this->format($date)]);
    }

    public function get(DateTimeInterface $date): Day
    {
        $this->validateDate($date);

        return $this->days[$this->format($date)];
    }

    /**
     * @return Day[]
     */
    public function getAll(): array
    {
        $result = [];
        foreach ($this->days as $day) {
            $result[] = $day;
        }
        usort($result, [$this, 'compareDays']);

        return $result;
    }

    /**
     * @param int $year
     * @return Day[]
     */
    public function getForYear(int $year): array
    {
        $result = [];
        foreach ($this->days as $day) {
            if ((int) $day->getDate()->format('Y') === $year) {
                $result[] = $day;
            }
        }
        usort($result, [$this, 'compareDays']);

        return $result;
    }

    private function add(Day $day): void
    {
        $this->days[$this->format($day->getDate())] = $day;
    }

    private function format(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d');
    }

    private function validateDate(DateTimeInterface $date): void
    {
        if (!array_key_exists($this->format($date), $this->days)) {
            throw new NoSpecialDayException(sprintf(
                'No special day for %s',
                $this->format($date)
            ));
        }
    }

    /**
     * @param Day $day1
     * @param Day $day2
     * @return int
     *
     * @SuppressWarnings(PHPMD.UnusedPrivateMethod)
     */
    private function compareDays(Day $day1, Day $day2): int
    {
        return $day1->getDate()->getTimestamp() - $day2->getDate()->getTimestamp();
    }
}
