<?php

declare(strict_types=1);

namespace Lalamove\Exceptions;

class TooManyRequestsException extends LalamoveException
{
    protected static int $statusCode = 429;
}