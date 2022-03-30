<?php

declare(strict_types=1);

namespace Lalamove\Exceptions;

class LalamoveException extends \RuntimeException
{
    protected static int $statusCode;

    public function getStatusCode(): int
    {
        return static::$statusCode;
    }
}