<?php

namespace Lalamove\Http\Clock;

class PslTimeClock implements ClockInterface
{
    public function getCurrentTimeInSeconds(): int
    {
        return time();
    }

    public function getCurrentTimeInMilliseconds(): int
    {
        return $this->getCurrentTimeInSeconds() * 1000;
    }
}