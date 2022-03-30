<?php

declare(strict_types=1);

namespace Lalamove\Exceptions;

class InvalidRequestException extends LalamoveException
{
    protected static int $statusCode = 400;
}