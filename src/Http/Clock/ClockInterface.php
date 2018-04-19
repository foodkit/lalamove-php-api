<?php

namespace Lalamove\Http\Clock;

interface ClockInterface
{
    public function getCurrentTimeInSeconds();
    public function getCurrentTimeInMilliseconds();
}