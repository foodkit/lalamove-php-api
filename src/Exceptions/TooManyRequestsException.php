<?php

namespace Lalamove\Exceptions;

class TooManyRequestsException extends LalamoveException
{
    protected static $statusCode = 429;
}