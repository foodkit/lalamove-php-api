<?php

declare(strict_types=1);

namespace Lalamove\Exceptions;

class ConflictException extends LalamoveException
{
    protected static int $statusCode = 409;
}