<?php

namespace Lalamove\Exceptions;

class UnauthorizedException extends LalamoveException
{
    protected static $statusCode = 401;
}