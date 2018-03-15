<?php

namespace Test\Unit\Adapter;

use Lencse\Adapter\Http\Messaging\GuzzleHttpResponseTransformer;
use PHPUnit\Framework\TestCase;

class GuzzleHttpResponseTransformerTest extends TestCase
{

    public function testResponse()
    {
        $transformer = new GuzzleHttpResponseTransformer();
        $result = $transformer->createResponse('{"test":1}');
        $this->assertEquals(200, $result->getStatusCode());
        $this->assertEquals('{"test":1}', $result->getBody());
        $this->assertEquals(['application/vnd.api+json'], $result->getHeader('Content-Type'));
    }
}
