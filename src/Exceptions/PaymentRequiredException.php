<?php

declare(strict_types=1);

namespace Lalamove\Exceptions;

class PaymentRequiredException extends LalamoveException
{
    protected static int $statusCode = 402;
}