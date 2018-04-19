<?php

namespace Lalamove\Exceptions;

class InvalidRequestException extends LalamoveException
{
    protected static $statusCode = 400;
}