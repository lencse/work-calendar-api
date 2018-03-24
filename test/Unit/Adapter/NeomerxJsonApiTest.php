<?php

namespace Test\Unit\Adapter;

use Lencse\Adapter\Http\JsonApi\NeomerxJsonApi;
use Lencse\Date\DateHelper;
use Lencse\WorkCalendar\Calendar\Day\Entity\Day;
use Lencse\WorkCalendar\Hu\Repository\HuDayTypeRepository;
use PHPUnit\Framework\TestCase;

class NeomerxJsonApiTest extends TestCase
{

    public function testOneDayType()
    {
        $jsonApi = new NeomerxJsonApi();
        $repo = new HuDayTypeRepository();
        $dayType = $repo->get(HuDayTypeRepository::SWITCHED_REST_DAY);
        $result = $jsonApi->transform($dayType);
        $expected = [
            'data' => $this->aDayType(),
        ];
        $this->assertEquals($expected, json_decode($result, true));
    }

    public function testDayTypes()
    {
        $jsonApi = new NeomerxJsonApi();
        $repo = new HuDayTypeRepository();
        $dayTypes = $repo->getAll();
        $result = $jsonApi->transform($dayTypes);
        $this->assertTrue(in_array($this->aDayType(), json_decode($result, true)['data']));
    }

    public function testOneDay()
    {
        $jsonApi = new NeomerxJsonApi();
        $repo = new HuDayTypeRepository();
        $dayType = $repo->get(HuDayTypeRepository::SWITCHED_REST_DAY);
        $day = new Day(DateHelper::dateTime('2018-03-15'), $dayType, 'Description');
        $result = $jsonApi->transform($day);
        $typeArr = $this->aDayType();
        unset($typeArr['links']);
        $expected = [
            'data' => $this->aDay(),
            'included' => [
                $typeArr
            ]
        ];
        $this->assertEquals($expected, json_decode($result, true));
    }

    private function aDayType(): array
    {
        return [
            'type' => 'day-types',
            'id' => 'switched-rest-day',
            'attributes' => [
                'key' => 'switched-rest-day',
                'name' => 'Áthelyezett pihenőnap',
                'is-rest-day' => true,
                'is-special' => true,
            ],
            'links' => [
                'self' => '/api/v1/day-types/switched-rest-day'
            ],
        ];
    }

    private function aDay(): array
    {
        return [
            'type' => 'days',
            'id' => '2018-03-15',
            'attributes' => [
                'date' => '2018-03-15T00:00:00+00:00',
                'description' => 'Description',
            ],
            'links' => [
                'self' => '/api/v1/days/2018-03-15'
            ],
            'relationships' => [
                'day-type' => [
                    'data' => [
                        'type' => 'day-types',
                        'id' => 'switched-rest-day',
                    ]
                ]
            ],
        ];
    }
}
