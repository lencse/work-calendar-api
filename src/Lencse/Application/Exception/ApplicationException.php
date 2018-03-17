<?php

namespace Lencse\Application\Exception;

use Exception;

abstract class ApplicationException extends Exception
{

    abstract public function getStatus(): string;
}
