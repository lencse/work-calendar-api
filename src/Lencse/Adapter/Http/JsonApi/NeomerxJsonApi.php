<?php

namespace Lencse\Adapter\Http\JsonApi;

use Lencse\Adapter\Http\JsonApi\Schema\DaySchema;
use Lencse\Adapter\Http\JsonApi\Schema\DayTypeSchema;
use Lencse\Application\Http\JsonApi\JsonApi;
use Lencse\WorkCalendar\Calendar\Day\Day;
use Lencse\WorkCalendar\Calendar\DayType\DayType;
use Neomerx\JsonApi\Contracts\Encoder\EncoderInterface;
use Neomerx\JsonApi\Encoder\Encoder;
use Neomerx\JsonApi\Encoder\EncoderOptions;

class NeomerxJsonApi implements JsonApi
{

    /**
     * @var EncoderInterface
     */
    private $jsonApi;

    public function __construct()
    {
        $mapping = [
            DayType::class => DayTypeSchema::class,
            Day::class => DaySchema::class,
        ];
        $this->jsonApi = Encoder::instance($mapping, new EncoderOptions(0, '/api/v1'));
    }

    /**
     * @param array|object $resource
     * @return string
     *
     * @psalm-suppress MixedInferredReturnType
     */
    public function transform($resource): string
    {
        return $this->jsonApi->encodeData($resource);
    }
}
