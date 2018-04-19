<?php

namespace Lalamove\Exceptions;

class ConflictException extends LalamoveException
{
    protected static $statusCode = 409;
}