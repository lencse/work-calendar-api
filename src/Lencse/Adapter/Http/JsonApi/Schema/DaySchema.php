<?php

namespace Lencse\Adapter\Http\JsonApi\Schema;

use Lencse\WorkCalendar\Calendar\Day\Entity\Day;
use Neomerx\JsonApi\Schema\BaseSchema;

class DaySchema extends BaseSchema
{

    /**
     * @var string
     */
    protected $resourceType = 'days';

    /**
     * @var string
     */
    protected $selfSubUrl = '/days';

    /**
     * @param Day $resource
     * @return string
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function getId($resource): string
    {
        return $resource->getDate()->format('Y-m-d');
    }

    /**
     * @param Day $resource
     * @param array|null $fieldKeysFilter
     * @return array
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function getAttributes($resource, array $fieldKeysFilter = null): array
    {
        return [
            'date' => $resource->getDate()->format('c'),
            'description' => $resource->getDescription(),
        ];
    }

    /**
     * @param Day $resource
     * @param bool $isPrimary
     * @param array $includeRelationships
     * @return array
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function getRelationships($resource, bool $isPrimary, array $includeRelationships): array
    {
        return [
            'day-type' => [
                self::DATA => $resource->getType(),
            ]
        ];
    }

    /**
     * @return string[]
     */
    public function getIncludePaths(): array
    {
        return ['day-type'];
    }
}
