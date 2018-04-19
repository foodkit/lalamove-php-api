<?php

namespace Lalamove\Exceptions;

class LalamoveException extends \RuntimeException
{
    /** @var int */
    protected static $statusCode;

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return static::$statusCode;
    }
}