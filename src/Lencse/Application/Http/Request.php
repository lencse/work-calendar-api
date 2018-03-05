<?php

namespace Lencse\Application\Http;

interface Request
{

    public function hasParam(string $key): bool;

    public function getParam(string $key);
}
