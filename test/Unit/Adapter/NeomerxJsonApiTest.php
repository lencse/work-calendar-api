<?php

namespace Test\Unit\Adapter;

use Lencse\Adapter\Http\JsonApi\NeomerxJsonApi;
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
            'data' => [
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
            ],
        ];
        $this->assertEquals($expected, json_decode($result, true));
    }
}
