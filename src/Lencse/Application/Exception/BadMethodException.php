<?php

namespace Lencse\Application\Exception;

class BadMethodException extends ApplicationException
{

    /**
     * @var int
     */
    protected $code = 405;

    public function getStatus(): string
    {
        return 'Method Not Allowed';
    }
}
