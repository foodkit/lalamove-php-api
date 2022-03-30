<?php

declare(strict_types=1);

namespace Lalamove\Exceptions;

class ForbiddenException extends LalamoveException
{
    protected static int $statusCode = 403;
}