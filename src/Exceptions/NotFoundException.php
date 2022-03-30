<?php

declare(strict_types=1);

namespace Lalamove\Exceptions;

class NotFoundException extends LalamoveException
{
    protected static int $statusCode = 404;
}