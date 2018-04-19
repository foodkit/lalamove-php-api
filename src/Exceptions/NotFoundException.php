<?php

namespace Lalamove\Exceptions;

class NotFoundException extends LalamoveException
{
    protected static $statusCode = 404;
}