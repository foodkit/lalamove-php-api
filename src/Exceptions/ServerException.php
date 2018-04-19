<?php

namespace Lalamove\Exceptions;

class ServerException extends LalamoveException
{
    protected static $statusCode = 500;
}