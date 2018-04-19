<?php

namespace Lalamove\Exceptions;

class ForbiddenException extends LalamoveException
{
    protected static $statusCode = 403;
}