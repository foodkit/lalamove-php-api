<?php

namespace Lalamove\Exceptions;

class LalamoveException extends \RuntimeException
{
    protected static $statusCode;

    public function getStatusCode(): int
    {
        return static::$statusCode;
    }
}