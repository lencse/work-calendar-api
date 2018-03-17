<?php

namespace Lencse\Application\Exception;

class NotFoundException extends ApplicationException
{

    /**
     * @var int
     */
    protected $code = 404;

    public function getStatus(): string
    {
        return 'Not Found';
    }
}
