<?php

namespace Lencse\Adapter\Http\JsonApi\Schema;

use Lencse\WorkCalendar\Calendar\DayType\Entity\DayType;
use Neomerx\JsonApi\Schema\BaseSchema;

class DayTypeSchema extends BaseSchema
{

    /**
     * @var string
     */
    protected $resourceType = 'day-types';

    /**
     * @var string
     */
    protected $selfSubUrl = '/day-types';

    /**
     * @param DayType $resource
     * @return string
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function getId($resource): string
    {
        return $resource->getKey();
    }

    /**
     * @param DayType $resource
     * @param array|null $fieldKeysFilter
     * @return array
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function getAttributes($resource, array $fieldKeysFilter = null): array
    {
        return [
            'key' => $resource->getKey(),
            'name' => $resource->getName(),
            'is-special' => $resource->isSpecial(),
            'is-rest-day' => $resource->isRestDay(),
        ];
    }
}
