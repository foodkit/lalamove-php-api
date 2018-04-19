<?php

namespace Lalamove\Exceptions;

class PaymentRequiredException extends LalamoveException
{
    protected static $statusCode = 402;
}