<?php

namespace Lencse\Application\Exception;

class BadRequestException extends ApplicationException
{

    /**
     * @var int
     */
    protected $code = 400;

    public function getStatus(): string
    {
        return 'Bad Request';
    }
}
