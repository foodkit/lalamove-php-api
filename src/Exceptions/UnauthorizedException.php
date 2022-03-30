<?php

declare(strict_types=1);

namespace Lalamove\Exceptions;

class UnauthorizedException extends LalamoveException
{
    protected static int $statusCode = 401;
}